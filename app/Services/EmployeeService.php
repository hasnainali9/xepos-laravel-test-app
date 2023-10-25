<?php
namespace App\Services;

use App\Models\Employee;

class EmployeeService{

    protected $employeeModel;
    public function __construct(){
        $this->employeeModel=new Employee();
    }



    public function filterData($request){
        return $this->employeeModel->with('company')->orderBy('first_name')
            ->filter($request->only('search', 'trashed'))
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($employee) => [
                'id' => $employee->id,
                'first_name' => $employee->first_name,
                'last_name' => $employee->last_name,
                'company_id' => $employee->company_id,
                'company_name' => $employee->company->name,
                'email' => $employee->email,
                'phone' => $employee->phone,
            ]);
    }



    public function CreateNewEmployee($request){
        return $this->employeeModel->create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'company_id'=>$request->company_id,
            'email'=>$request->email,
            'phone'=>$request->phone,
        ]);
    }



    public function getSingleRecordUsingId($id){
        return $this->employeeModel->with('company')->where('id',$id)->first();
    }



    public function updateEmployee($request,$id){
        return $this->employeeModel->where('id',$id)->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'company_id'=>$request->company_id,
            'email'=>$request->email,
            'phone'=>$request->phone,
        ]);
    }



    public function deleteEmployee($id){
        return $this->employeeModel->where('id',$id)->delete();
    }





}
