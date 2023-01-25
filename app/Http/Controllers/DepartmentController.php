<?php

namespace App\Http\Controllers;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as Requests;
use Inertia\Inertia;


class DepartmentController extends Controller
{
    public function index(){
        $perPage = Requests::input('perPage') ?: 5;
        return Inertia::render('Department/Index',[
            'departments' => Department::query()
            ->when(Requests::input('search'), function($query, $search){
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate($perPage)
            ->withQueryString(),
            'filters' => Requests::only(['search', 'perPage'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Department/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments,name',
        ]);

            Department::create([
                'name' => $request->name,
            ]);
            return Redirect::route('departments.index')->with('message', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        return Inertia::render('Department/Edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|unique:departments,name',
        ]);

        $department->update([
            'name' => $request->name
        ]);
        return Redirect::route('departments.index')->with('message', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return Redirect::back()->with('message', 'Action completed.');
    }
}
