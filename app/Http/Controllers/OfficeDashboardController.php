<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class OfficeDashboardController extends Controller
{
    public function index()
{
    // Get only announcements uploaded by the authenticated user
    $announcements = Announcement::with('user', 'images')
        ->where('user_id', auth()->id()) // Filter by the authenticated user's ID
        ->orderBy('created_at', 'desc') // Order announcements by the latest (most recent first)
        ->get();

    // Get all school years (assuming you want to display them in the view)
    $schoolYears = SchoolYear::all();

    // Pass the announcements and school years to the view
    return view('Office.dashboard', compact('announcements', 'schoolYears'));
}




}
