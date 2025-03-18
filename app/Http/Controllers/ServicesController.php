<?php

namespace App\Http\Controllers;

use App\Models\Service; // Assuming you have a Service model
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the services.
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'service_title' => 'required|string|max:255',
            'service_description' => 'nullable|string',
            'service_price' => 'required|numeric|min:0',
            'length_of_service_minutes' => 'required|integer|min:1',
            'max_participants' => 'nullable|integer|min:1',
            'exclusions' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        // Create a new service
        Service::create($request->all());

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified service.
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, Service $service)
    {
        // Validate the request data
        $request->validate([
            'service_title' => 'required|string|max:255',
            'service_description' => 'nullable|string',
            'service_price' => 'required|numeric|min:0',
            'length_of_service_minutes' => 'required|integer|min:1',
            'max_participants' => 'nullable|integer|min:1',
            'exclusions' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        // Update the service
        $service->update($request->all());

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}