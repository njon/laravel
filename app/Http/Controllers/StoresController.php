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
}