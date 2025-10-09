<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Boarding;
use Illuminate\Http\Request;

class BoardingListController extends Controller
{
    // Display all properties
    public function index()
    {
        // Fetch all boarding properties with related photos
        $properties = Boarding::with('photos')->get();

        // Pass to view
        return view('pages.properties', compact('properties'));
    }

    // Approve property
    public function approve($id)
    {
        $property = Boarding::findOrFail($id);
        $property->is_approved = true;
        $property->save();

        return redirect()->route('admin.properties')->with('success', 'Property approved successfully!');
    }

    // Delete property
    public function destroy($id)
    {
        $property = Boarding::findOrFail($id);
        $property->delete();

        return redirect()->route('admin.properties')->with('success', 'Property deleted successfully!');
    }
}
