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

 