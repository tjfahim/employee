<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::where('status', 'active')->latest()->paginate(5);
        return view('backend.dashboard', compact('employees'));
    }


    public function store(Request $request)
    {
        // Manual validation of form data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'phone' => 'required|unique:employees',
            'password' => 'required|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'employee_id' => 'nullable|unique:employees',
            'status' => 'in:active,inactive',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); // 422 Unprocessable Entity
        }
    
        // Handle the file upload if image is present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        } else {
            $imagePath = null;
        }
    
        // Create a new Employee instance and fill with form data
        $employee = new Employee();
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->password = bcrypt($request->input('password'));
        $employee->image = $imagePath;
        $employee->employee_id = $request->input('employee_id');
        $employee->status = $request->input('status', 'active');
    
        // Save the employee data to the database
        $employee->save();
    
        // Optionally, you can return a response or redirect to a specific route
        return response()->json(['status' => 'success']);
    }
    
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'u_name' => 'required',
            'u_email' => 'required|email|unique:employees,email,' . $request->u_id,
            'u_phone' => 'required|unique:employees,phone,' . $request->u_id,
            'u_password' => 'required',
            'u_employee_id' => 'nullable|unique:employees,employee_id,' . $request->u_id,
            'u_status' => 'in:active,inactive',
        ]);

      Employee::where('id', $request->u_id)->update([
      'name' => $request->u_name,
      'email' => $request->u_email,
      'phone' => $request->u_phone,
      'password' => $request->u_password,
      'employee_id' => $request->u_employee_id,
      ]);
      
        return response()->json(['status' => 'update']);

    }
    public function destroy(Request $request)
    {

      Employee::where('id', $request->id)->update([
      'status' => 'inactive',
      ]);
      
        return response()->json(['status' => 'deleted']);

    }

 
}
