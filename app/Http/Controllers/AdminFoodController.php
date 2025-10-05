<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodMenu;

class AdminFoodController extends Controller
{
    // Display all food packages
    public function index()
    {
        $foodMenus = FoodMenu::orderBy('created_at', 'desc')->get();
        return view('pages.vendors', compact('foodMenus'));
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

    // Delete a food package
    public function destroy($id)
    {
        $food = FoodMenu::findOrFail($id);
        $food->delete();

        // Redirect to admin.vendors route
        return redirect()->route('admin.vendors')->with('success', 'Food package deleted successfully!');
    }
}
