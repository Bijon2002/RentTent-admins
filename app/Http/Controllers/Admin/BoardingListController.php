<?php

namespace App\Http\Controllers\Admin;

use App\Models\Boarding;
use Illuminate\Http\Request;

class BoardingListController extends AdminBaseController
{
    // Display all properties
    public function index()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        // Fetch all boarding properties with related photos
        $properties = Boarding::with('photos')->get();
        $statsData = $this->getStatsData();

        // Pass to view
        return view('pages.properties', array_merge(compact('properties'), $statsData));
    }

    // Approve property
    public function approve($id)
    {
        $property = Boarding::findOrFail($id);
        $property->is_approved = true;
        $property->save();

        return redirect()->route('admin.properties')->with('success', 'Property approved successfully!');
    }

    // Show create property form
    public function create()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $statsData = $this->getStatsData();
        return view('admin.create_property', $statsData);
    }

    // Store new property
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'monthly_rent' => 'required|numeric|min:0',
            'room_type' => 'required|in:single,double,shared,studio',
            'is_food_included' => 'boolean',
            'police_zone_rating' => 'required|integer|min:1|max:5',
            'posted_date' => 'required|date',
            'is_approved' => 'boolean',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('photos');
        
        // Set default admin user_id (001) for properties created by admin
        $data['user_id'] = 1; // Default admin user ID
        
        $property = Boarding::create($data);

        // Handle photo uploads
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $imagePath = $photo->store('property_photos', 'public');
                $property->photos()->create([
                    'image_url' => $imagePath,
                    'is_main' => $index === 0, // First photo is main
                ]);
            }
        }

        return redirect()->route('admin.properties')->with('success', 'Property created successfully.');
    }

    // Show edit property form
    public function edit($id)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $property = Boarding::with('photos')->findOrFail($id);
        $statsData = $this->getStatsData();
        return view('admin.edit_property', array_merge(compact('property'), $statsData));
    }

    // Update property
    public function update(Request $request, $id)
    {
        $property = Boarding::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'monthly_rent' => 'required|numeric|min:0',
            'room_type' => 'required|in:single,double,shared,studio',
            'is_food_included' => 'boolean',
            'police_zone_rating' => 'required|integer|min:1|max:5',
            'posted_date' => 'required|date',
            'is_approved' => 'boolean',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('photos');
        $property->update($data);

        // Handle new photo uploads
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $imagePath = $photo->store('property_photos', 'public');
                $property->photos()->create([
                    'image_url' => $imagePath,
                    'is_main' => false,
                ]);
            }
        }

        return redirect()->route('admin.properties')->with('success', 'Property updated successfully.');
    }

    // Delete property
    public function destroy($id)
    {
        $property = Boarding::findOrFail($id);
        $property->delete();

        return redirect()->route('admin.properties')->with('success', 'Property deleted successfully!');
    }
}
