<?php

namespace App\Http\Controllers;

use App\Models\Store; // Assuming you have a Store model
use Illuminate\Http\Request;

class StoresController extends Controller
{
    /**
     * Display a listing of the stores.
     */
    public function index()
    {
        $stores = Store::all();
        return view('stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new store.
     */
    public function create()
    {
        return view('stores.create');
    }

    /**
     * Store a newly created store in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'business_name' => 'required|string|max:255',
            'mobile_phone' => 'required|string|max:20',
            'email_address' => 'required|string|email',
            'business_address' => 'required|string',
            'website' => 'nullable|url',
            'description' => 'nullable|string',
            'working_hours' => 'nullable|json',
            'user_id' => 'required|exists:users,id', // Ensure user_id exists in users table
        ]);

        // Create a new store
        Store::create($request->all());

        return redirect()->route('stores.index')->with('success', 'Store created successfully.');
    }

    /**
     * Display the specified store.
     */
    public function show(Store $store)
    {
        return view('stores.show', compact('store'));
    }

    /**
     * Show the form for editing the specified store.
     */
    public function edit(Store $store)
    {
        return view('stores.edit', compact('store'));
    }

    /**
     * Update the specified store in storage.
     */
    public function update(Request $request, Store $store)
    {
        // Validate the request data
        $request->validate([
            'business_name' => 'required|string|max:255',
            'mobile_phone' => 'required|string|max:20',
            'email_address' => 'required|string|email',
            'business_address' => 'required|string',
            'website' => 'nullable|url',
            'description' => 'nullable|string',
            'working_hours' => 'nullable|json',
            'user_id' => 'required|exists:users,id',
        ]);

        // Update the store
        $store->update($request->all());

        return redirect()->route('stores.index')->with('success', 'Store updated successfully.');
    }

    /**
     * Remove the specified store from storage.
     */
    public function destroy(Store $store)
    {
        $store->delete();
        return redirect()->route('stores.index')->with('success', 'Store deleted successfully.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image')->store('store-images', 'public');
        return response()->json(['path' => $path, 'message' => 'Image uploaded successfully!']);
    }

    public function deleteImage(Request $request)
    {
        $filename = $request->input('filename');
        $path = public_path('storage/store-images/' . $filename);

        if (file_exists($path)) {
            unlink($path);
            return response()->json(['message' => 'Image deleted successfully!']);
        }

        return response()->json(['message' => 'Image not found!'], 404);
    }

    public function uploadGallery(Request $request)
    {
        $request->validate([
            'gallery.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $paths = [];
        foreach ($request->file('gallery') as $file) {
            $paths[] = $file->store('store-gallery', 'public');
        }

        return response()->json(['paths' => $paths, 'message' => 'Gallery images uploaded successfully!']);
    }

    public function deleteGallery(Request $request)
    {
        $filename = $request->input('filename');
        $path = public_path('storage/store-gallery/' . $filename);

        if (file_exists($path)) {
            unlink($path);
            return response()->json(['message' => 'Gallery image deleted successfully!']);
        }

        return response()->json(['message' => 'Gallery image not found!'], 404);
    }
}