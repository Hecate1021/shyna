<?php

namespace App\Http\Controllers;

use App\Mail\AnnouncementCreated;
use App\Models\Announcement;
use App\Models\ImageUpload;
use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AnnouncementController extends Controller
{
    public function store(Request $request)
    {
        // Validate inputs
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'department' => 'required|string|max:255',
            'academic_year' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max per image
        ]);

        // Create the announcement
        $announcement = Announcement::create([
            'user_id' => Auth::id(), // cleaner: Auth::id() instead of Auth()->id()
            'title' => $validated['title'],
            'description' => $validated['description'],
            'department' => $validated['department'],
            'academic_year' => $validated['academic_year'],
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'],
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('announcement_images', 'public');
                ImageUpload::create([
                    'announcement_id' => $announcement->id,
                    'image_path' => $path,
                ]);
            }
        }

        // Send email to users in the selected department
        $users = User::where('department', $validated['department'])->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new AnnouncementCreated($announcement));
        }

        return redirect()->back()->with('success', 'Announcement created successfully!');
    }

    public function viewAllAnnouncements()
    {
        $announcements = Announcement::with('images', 'user')->get(); // (also adding 'user' if you need)
        $schoolYears = SchoolYear::all(); // get all school years
        return view('Announcement.index', compact('announcements', 'schoolYears'));
    }
}
