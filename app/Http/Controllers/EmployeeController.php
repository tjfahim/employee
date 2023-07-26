<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::where('status', 'active')->where('role','employee')->latest()->paginate(5);
        return view('backend.dashboard', compact('employees'));
    }


    public function store(Request $request)
    {
        // Manual validation of form data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:4',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'employee_id' => 'nullable|unique:users',
            'status' => 'in:active,inactive',
            'designation' => 'nullable',
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
        $employee = new User();
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->password = bcrypt($request->input('password'));
        $employee->image = $imagePath;
        $employee->employee_id = $request->input('employee_id');
        $employee->status = $request->input('status', 'active');
        $employee->designation = $request->input('designation');
        $employee->role = 'employee';
    
        // Save the employee data to the database
        $employee->save();
    
        // Optionally, you can return a response or redirect to a specific route
        return response()->json(['status' => 'success']);
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
            'u_designation' => 'nullable',
        ]);

      User::where('id', $request->u_id)->update([
      'name' => $request->u_name,
      'email' => $request->u_email,
      'phone' => $request->u_phone,
      'password' => $request->u_password,
      'employee_id' => $request->u_employee_id,
      'designation' => $request->u_designation,
      ]);
      
        return response()->json(['status' => 'update']);

    }
    public function destroy(Request $request)
    {

      User::where('id', $request->id)->update([
      'status' => 'inactive',
      ]);
      
        return response()->json(['status' => 'deleted']);

    }

 
}
