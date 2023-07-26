<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\IpList;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $employees = User::where('status', 'active')->where('role','employee')->latest()->paginate(5);
        return view('backend.dashboard', compact('employees'));
    }
    
}
