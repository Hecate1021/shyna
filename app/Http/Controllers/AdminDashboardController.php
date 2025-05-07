<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function accountFaculty(Request $request)
    {
        $department = $request->input('department');

        $users = User::where('role', 'user')
            ->when($department, function ($query, $department) {
                return $query->where('department', $department);
            })
            ->get();

        return view('admin.accountfaculty', compact('users', 'department'));
    }


    public function accountList(Request $request)
{
    $department = $request->get('department');

    $users = User::where('role', 'user')
        ->when($department, function ($query, $department) {
            return $query->where('department', $department);
        })
        ->get();

    return view('admin.accountfaculty', compact('users', 'department'));
}

}
