<?php

namespace App\Http\Controllers;

use App\Models\User; // Assuming you have a User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // For password hashing

class UsersController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::all(); // Fetch all users from the database
        return view('users.index', compact('users')); // Return a view with users data
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create'); // Return the create user form view
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'full_name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'work_email' => 'required|string|email|unique:users',
            'work_phone' => 'nullable|string|max:20',
            'access_level' => 'required|in:basic,editor,admin',
            'password' => 'required|string|min:8|confirmed', // 'confirmed' checks for password_confirmation field
        ]);

        // Create a new user
        User::create([
            'full_name' => $request->full_name,
            'job_title' => $request->job_title,
            'work_email' => $request->work_email,
            'work_phone' => $request->work_phone,
            'access_level' => $request->access_level,
            'password' => Hash::make($request->password), // Hash the password
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.'); // Redirect with success message
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user')); // Return view with user details
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user')); // Return edit form view
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate the request data
        $request->validate([
            'full_name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'work_email' => 'required|string|email|unique:users,work_email,' . $user->id, // Ignore current user's email
            'work_phone' => 'nullable|string|max:20',
            'access_level' => 'required|in:basic,editor,admin',
            'password' => 'nullable|string|min:8|confirmed', // Password is nullable for update
        ]);

        // Update the user
        $user->full_name = $request->full_name;
        $user->job_title = $request->job_title;
        $user->work_email = $request->work_email;
        $user->work_phone = $request->work_phone;
        $user->access_level = $request->access_level;
        if ($request->password) {
            $user->password = Hash::make($request->password); // Hash the new password if provided
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.'); // Redirect with success message
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.'); // Redirect with success message
    }

    public function uploadAvatar(Request $request, $id)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);

        // Store the uploaded file
        $path = $request->file('avatar')->store('avatars', 'public');

        // Update user's avatar URL
        $user->image = '/storage/' . $path;
        $user->save();

        return response()->json(['message' => 'Avatar uploaded successfully!', 'path' => $user->image]);
    }

    public function deleteAvatar($id)
    {
        $user = User::findOrFail($id);

        // Delete the avatar file
        if ($user->image) {
            $filePath = public_path($user->image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $user->image = null;
            $user->save();
        }

        return response()->json(['message' => 'Avatar deleted successfully!']);
    }
}