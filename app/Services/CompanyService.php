<?php
namespace App\Services;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Request;


class CompanyService{
    protected $companyModel;
    protected $employeeModel;
    public function __construct(){
        $this->companyModel=new Company();
        $this->employeeModel=new Employee();
    }

    public function filterData($request){
        return $this->companyModel->orderBy('name')
            ->filter($request->only('search', 'trashed'))
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($company) => [
                'id' => $company->id,
                'name' => $company->name,
                'email' => $company->email,
                'logo' => $company->logo,
                'website' => $company->website,
            ]);
    }

    public function storeLogoFile($request){
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $timestamp = now()->timestamp; // Get the current timestamp
            $customName = 'logo_' . $timestamp . '.' . $file->getClientOriginalExtension();

            // Store the file with the custom name in the 'company_logos' disk
            $path = $file->storeAs('company_logos', $customName, 'public');

            return '/storage/company_logos/'.$customName;
        }
    }

    public function CreateNewCompany($request){
        return $this->companyModel->create([
           'name'=>$request->name,
           'email'=>$request->email,
           'logo'=>$this->storeLogoFile($request),
           'website'=>$request->website
        ]);
    }



    public function getSingleRecordUsingId($id){
        return $this->companyModel->with('employees')->where('id',$id)->first();
    }

    public function getAllRecords(){
        return $this->companyModel->all();
    }

    public function UpdateCompany($request,$id){
        return $this->companyModel->where('id',$id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'logo'=>$this->storeLogoFile($request),
            'website'=>$request->website
        ]);
    }


    public function deleteCompanyWithEmployees($id){
        $this->employeeModel->where('company_id',$id)->delete();
        return $this->companyModel->where('id',$id)->delete();
    }



}
