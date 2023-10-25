<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\CreateCompanyRequest;
use App\Http\Requests\Companies\UpdateCompanyRequest;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CompanyController extends Controller
{
    protected $companyService;
    public function __construct(CompanyService $companyService) {
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Company/index', [
            'filters' => $request->all('search', 'trashed'),
            'companies' =>$this->companyService->filterData($request),
            'auth' => [
                'user' => auth()->user()
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Company/create',[
            'auth' => [
                'user' => auth()->user()
            ]
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCompanyRequest $request)
    {
        $company=$this->companyService->CreateNewCompany($request);
        if($company){
            return redirect('companies')->with('success', 'Company created.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Company=$this->companyService->getSingleRecordUsingId($id);
        if($Company){
            return Inertia::render('Company/edit', [
                'company' =>$Company,
                'auth' => [
                    'user' => auth()->user()
                ]
            ]);
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, string $id)
    {
        $company=$this->companyService->UpdateCompany($request,$id);
        if($company){
            return Inertia::location('/companies/'.$id.'/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->companyService->deleteCompanyWithEmployees($id);
        return Inertia::location('/companies');

    }
}
