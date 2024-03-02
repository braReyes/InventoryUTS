<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Inertia\Inertia;


class DepartmentController extends Controller
{
    public function index()
{
    $departments = Department::all();

    return Inertia::render('Departments/Index', [
        'departments' => $departments,
    ]);
}



    public function create()
    {
        return Inertia::render('Departments/Create');
    }
    
    public function store(Request $request)
{
    $request->validate(['name' => 'required|max:100', 'count' => 'required|integer|min:1']);
    
    // Buscar el departamento con el mismo nombre
    $existingDepartment = Department::where('name', $request->input('name'))->first();
    
    if ($existingDepartment) {
        $existingDepartment->count = $request->input('count'); // Establecer la cantidad con el valor ingresado
        $existingDepartment->save();
    } else {
        $department = new Department([
            'name' => $request->input('name'),
            'count' => $request->input('count') // Establecer la cantidad con el valor ingresado
        ]);

        $department->save();
    }
    
    return redirect('departments');
}


    public function show(Department $department)
    {
        //
    }
    public function edit(Department $department)
    {
        return Inertia::render('Departments/Edit',['department' => $department]);
    }

    public function est(Department $department)
    {
        return Inertia::render('Departments/Estado',['department' => $department]);
    }
   

    public function update(Request $request, Department $department)
    {
        $request->validate(['name' => 'required|max:100']);
        $department->update($request->all());
        return redirect('departments');
    }
        public function destroy(Department $department)
    {
        if ($department->count > 0) {
            
            $department->count--;
            $department->save();
        } else {
            
            $department->delete();
        }

        return redirect('departments');
    }

    

}
