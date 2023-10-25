<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\CreateEmployeeRequest;
use App\Services\CompanyService;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    protected $employeeService;
    protected $companyService;
    public function __construct(EmployeeService $employeeService,CompanyService $companyService) {
        $this->employeeService = $employeeService;
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Employee/index', [
            'filters' => $request->all('search', 'trashed'),
            'employees' =>$this->employeeService->filterData($request),
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
        return Inertia::render('Employee/create',[
            'companies'=>$this->companyService->getAllRecords(),
            'auth' => [
                'user' => auth()->user()
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEmployeeRequest $request)
    {
        $company=$this->employeeService->CreateNewEmployee($request);
        if($company){
            return redirect('employees')->with('success', 'Employee created.');
        }
    }

//    /**
//     * Display the specified resource.
//     */
//    public function show(string $id)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee=$this->employeeService->getSingleRecordUsingId($id);
        if($employee){
            return Inertia::render('Employee/edit', [
                'employee' =>$employee,
                'companies'=>$this->companyService->getAllRecords(),
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
    public function update(Request $request, string $id)
    {
        $employee=$this->employeeService->updateEmployee($request,$id);
        if($employee){
            return Inertia::location('/employees/'.$id.'/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->employeeService->deleteEmployee($id);
        return Inertia::location('/employees');
    }
}
