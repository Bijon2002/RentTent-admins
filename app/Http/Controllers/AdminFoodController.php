<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodMenu;
use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Support\Facades\Storage; // ✅ for file handling

class AdminFoodController extends AdminBaseController
{
    // Display all food packages
    public function index()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $foodMenus = FoodMenu::latest()->paginate(10); // ✅ use pagination instead of loading all
        $statsData = $this->getStatsData();

        return view('pages.vendors', compact('foodMenus') + $statsData);
    }

    // Approve a food package
   public function approve($id)
    {
        $food = FoodMenu::findOrFail($id);
        $food->update(['approved' => true]); // ✅ shorter syntax

        return redirect()
            ->route('admin.vendors')
            ->with('success', "✅ '{$food->name}' approved successfully!");
    }
    // Show create food package form
    public function create()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        return view('admin.create_vendor', $this->getStatsData());
    }

    // Store new food package
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'food_type' => 'required|in:breakfast,lunch,dinner',
            'preference' => 'required|in:veg,non_veg,both',
            'monthly_fee' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'approved' => 'boolean',
        ]);

        // ✅ handle image upload safely
        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('food_images', 'public');
            $validated['image_url'] = $path;
        }

        // ✅ auto-approve if admin checked it, default false
        $validated['approved'] = $request->boolean('approved', false);

        FoodMenu::create($validated);

        return redirect()
            ->route('admin.vendors')
            ->with('success', '🍽️ Food package created successfully!');
    }
}
 