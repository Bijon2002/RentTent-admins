<?php
namespace App\Http\Controllers;

use App\Models\FoodMenu;

class SuggestionController extends Controller
{
    public function index()
    {
        $foodVendors = FoodMenu::where('approved', 1)->get();
        return view('includes.suggestions', compact('foodVendors'));
    }
}
