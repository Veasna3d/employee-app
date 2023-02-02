<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as Requests;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function index(){

         $perPage = Requests::input('perPage') ?: 5;
         return Inertia::render('Employee/Index',[
             'employees' => Employee::query()
             ->when(Requests::input('search'), function($query, $search){
                 $query->where('first_name', 'like', "%{$search}%");
             })
             ->paginate($perPage)
             ->withQueryString(),
             'filters' => Requests::only(['search', 'perPage']),
         ]);
     }

     public function create()
     {
         $countries = Country::all();
         $states = State::all();
         $departments = Department::all();
         return Inertia::render('Employee/Create', compact('countries','states','departments'));
     }

     public function store(Request $request)
     {
         $request->validate([
             //'name' => 'required|unique:states,name',
             'firstName' => 'required',
             'lastName' => 'required',
         //    'middleName' => 'required',
             'address' => 'required',
             'department_id' => 'required',
             'country_id' => 'required',
             'state_id' => 'required',
           //  'zipCode' => 'required',
             'birthDate' => 'required',
             'hiredDate' => 'required',
         ]);

             Employee::create([
                 'firstName' => $request->firstName,
                 'lastName' => $request->lastName,
                 'middleName' => $request->middleName,
                 'address' => $request->address,
                 'department_id' => $request->department_id,
                 'country_id' => $request->country_id,
                 'state_id' => $request->state_id,
                 'zipCode' => $request->zipCode,
                 'birthDate' => $request->birthDate,
                 'hiredDate' => $request->hiredDate,
             ]);
             return Redirect::route('employees.index')->with('message', 'Employee created successfully.');
     }

     public function edit(Employee $employee)
     {
        $countries = Country::all();
        $states = State::all();
        $departments = Department::all();
         return Inertia::render('Employee/Edit', compact('countries', 'states', 'departments'));
     }

     public function update(Request $request, Employee $employee)
     {
        $request->validate([
            //'name' => 'required|unique:states,name',
            'firstName' => 'required',
            'lastName' => 'required',
           // 'middleName' => 'required',
            'address' => 'required',
            'department_id' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
          //  'zipCode' => 'required',
            'birthDate' => 'required',
            'hiredDate' => 'required',
        ]);
         $employee->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'middleName' => $request->middleName,
            'address' => $request->address,
            'department_id' => $request->department_id,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'zipCode' => $request->zipCode,
            'birthDate' => $request->birthDate,
            'hiredDate' => $request->hiredDate,
         ]);
         return Redirect::route('employees.index')->with('message', 'Employee updated successfully.');
     }

     public function destroy(Employee $employee)
     {
         $employee->delete();
         return Redirect::back()->with('message', 'Action completed.');
     }
}
