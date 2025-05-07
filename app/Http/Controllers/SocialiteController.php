<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\facades\Socialite;

class SocialiteController extends Controller
{
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    // app/Http/Controllers/SocialiteController.php
    public function googleCallback()
{
    try {
        // Retrieve the authenticated user from Google
        $googleAuth = Socialite::driver('google')->user();

        // Check if the user already exists using their email address
        $user = User::where('email', $googleAuth->email)->first();

        if ($user) {
            // If user exists, log them in
            Auth::login($user);

            // Check if the user needs to fill the additional info
            if (empty($user->position) || empty($user->department)) {
                return redirect()->route('user.profile.fill');
            }

            return redirect()->route('dashboard');
        } else {
            // Otherwise, create a new user
            $userData = User::create([
                'name' => $googleAuth->name,
                'email' => $googleAuth->email,
                'google_id' => $googleAuth->id, // Save Google ID
                'avatar' => $googleAuth->avatar, // Save Avatar URL
                'role' => 'user',
                'password' => Hash::make('12345678'), // Default password
            ]);

            // Log the newly created user in
            Auth::login($userData);

            // Redirect to the profile fill page
            return redirect()->route('user.profile.fill');
        }
    } catch (\Exception $e) {
        return redirect()->route('login')->with('error', 'An error occurred while logging you in. Please try again.');
    }
}

    public function saveProfileData(Request $request)
    {
        $user = Auth::user();

        // Validate the input
        $request->validate([
            'position' => 'required|string|max:255',
            'department' => 'required|in:CCS,COE,NABA',
        ]);

        // Update user data
        $user->position = $request->input('position');
        $user->department = $request->input('department');
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Your profile has been updated.');
    }
    public function showProfileForm()
    {
        return view('user.profile_fill'); // Display the form view
    }
}
