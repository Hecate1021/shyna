<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get the logged-in user

        // Get announcements for the same department as the user
        $announcements = Announcement::with('user', 'images')
            ->where('department', $user->department) // Filter announcements by user's department
            ->orderBy('created_at', 'desc') // Order announcements by latest
            ->get();

        // Pass announcements to the view
        return view('dashboard', compact('announcements'));
    }

}
