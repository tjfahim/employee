<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\IpList;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $employees = Employee::where('status', 'active')->latest()->paginate(5);
        return view('backend.dashboard', compact('employees'));
    }
    
}
