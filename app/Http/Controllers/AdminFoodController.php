<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodMenu;
use App\Http\Controllers\Admin\AdminBaseController;

class AdminFoodController extends AdminBaseController
{
    // Display all food packages
    public function index()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $foodMenus = FoodMenu::orderBy('created_at', 'desc')->get();
        $statsData = $this->getStatsData();
        return view('pages.vendors', array_merge(compact('foodMenus'), $statsData));
    }

    // Approve a food package
    public function approve($id)
    {
        $food = FoodMenu::findOrFail($id);
        $food->approved = true;
        $food->save();

        // Redirect to admin.vendors route (note the 'admin.' prefix)
        return redirect()->route('admin.vendors')->with('success', 'Food package approved successfully!');
    }

    // Show create food package form
    public function create()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $statsData = $this->getStatsData();
        return view('admin.create_vendor', $statsData);
    }

    // Store new food package
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'food_type' => 'required|in:breakfast,lunch,dinner',
            'preference' => 'required|in:veg,non_veg,both',
            'monthly_fee' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'approved' => 'boolean',
        ]);

        $data = $request->all();
        
        // Set default admin user_id (001) for food packages created by admin
        $data['user_id'] = 1; // Default admin user ID
        
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('food_images', 'public');
            $data['image_url'] = $imagePath;
        }

        FoodMenu::create($data);

        return redirect()->route('admin.vendors')->with('success', 'Food package created successfully.');
    }

    // Show edit food package form
    public function edit($id)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $foodMenu = FoodMenu::findOrFail($id);
        $statsData = $this->getStatsData();
        return view('admin.edit_vendor', array_merge(compact('foodMenu'), $statsData));
    }

    // Update food package
    public function update(Request $request, $id)
    {
        $foodMenu = FoodMenu::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'food_type' => 'required|in:breakfast,lunch,dinner',
            'preference' => 'required|in:veg,non_veg,both',
            'monthly_fee' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'approved' => 'boolean',
        ]);

        $data = $request->all();
        
        // Ensure user_id is set (keep existing or set to admin)
        if (!isset($data['user_id']) || empty($data['user_id'])) {
            $data['user_id'] = 1; // Default admin user ID
        }
        
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('food_images', 'public');
            $data['image_url'] = $imagePath;
        }

        $foodMenu->update($data);

        return redirect()->route('admin.vendors')->with('success', 'Food package updated successfully.');
    }

    // Delete a food package
    public function destroy($id)
    {
        $food = FoodMenu::findOrFail($id);
        $food->delete();

        // Redirect to admin.vendors route
        return redirect()->route('admin.vendors')->with('success', 'Food package deleted successfully!');
    }
}
