<?php

namespace App\Http\Controllers;

use App\Models\Boarding;
use App\Models\RoomPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;


class BoardingController extends Controller
{
    // Show all boardings for logged-in provider
    public function index()
    {
        $boardings = Boarding::with('photos')->where('user_id', Auth::id())->get();
        return view('pages.manage_boardings', compact('boardings'));
    }

    // Show only approved boardings to public
public function approvedBoardings()
{
    $boardings = Boarding::with('photos')
        ->where('is_approved', true)   // only approved
        ->get();

    return view('pages.properties', compact('boardings'));
}




    // Store new boarding
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'monthly_rent' => 'required|numeric',
            'advance_percent' => 'nullable|numeric',
            'is_refundable' => 'nullable|boolean',
            'room_type' => 'required|string',
            'room_size' => 'nullable|integer',
            'is_food_included' => 'required|boolean',
            'gender_preference' => 'nullable|in:male,female,any',
            'wifi' => 'nullable|boolean',
            'parking' => 'nullable|boolean',
            'laundry' => 'nullable|boolean',
            'attached_bathroom' => 'nullable|boolean',
            'furnished' => 'nullable|boolean',
            'property_doc_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'police_report_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'privacy_policy' => 'nullable|string',
            'posted_date' => 'required|date',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle file uploads
        if ($request->hasFile('property_doc_image')) {
            $validated['property_doc_image'] = $request->file('property_doc_image')->store('boardings/docs', 'public');
        }
        if ($request->hasFile('police_report_image')) {
            $validated['police_report_image'] = $request->file('police_report_image')->store('boardings/docs', 'public');
        }

        // Save Boarding
        $boarding = Boarding::create(array_merge($validated, [
            'user_id' => Auth::id(),
            'is_approved' => false,
            'trust_score' => 0,
            'police_zone_rating' => 0,
            'availability_status' => 'available',
        ]));

        // Save Photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $path = $photo->store('boardings', 'public');
                $boarding->photos()->create([
                    'image_url' => $path,
                    'is_main' => $index === 0,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Boarding added successfully!');
    }

    // Update a boarding
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'monthly_rent' => 'required|numeric',
            'advance_percent' => 'nullable|numeric',
            'is_refundable' => 'nullable|boolean',
            'room_type' => 'required|in:single,shared,family',
            'room_size' => 'nullable|integer',
            'is_food_included' => 'required|boolean',
            'gender_preference' => 'nullable|in:male,female,any',
            'wifi' => 'nullable|boolean',
            'parking' => 'nullable|boolean',
            'laundry' => 'nullable|boolean',
            'attached_bathroom' => 'nullable|boolean',
            'furnished' => 'nullable|boolean',
            'property_doc_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'police_report_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'privacy_policy' => 'nullable|string',
            'posted_date' => 'required|date',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'main_photo' => 'nullable|integer|exists:room_photos,photo_id',
        ]);

        $boarding = Boarding::where('user_id', Auth::id())->findOrFail($id);

        // Handle new file uploads
        if ($request->hasFile('property_doc_image')) {
            Storage::disk('public')->delete($boarding->property_doc_image);
            $boarding->property_doc_image = $request->file('property_doc_image')->store('boardings/docs', 'public');
        }
        if ($request->hasFile('police_report_image')) {
            Storage::disk('public')->delete($boarding->police_report_image);
            $boarding->police_report_image = $request->file('police_report_image')->store('boardings/docs', 'public');
        }

        // Update Boarding info
        $boarding->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'monthly_rent' => $request->monthly_rent,
            'advance_percent' => $request->advance_percent ?? $boarding->advance_percent,
            'is_refundable' => $request->is_refundable ?? $boarding->is_refundable,
            'room_type' => $request->room_type,
            'room_size' => $request->room_size,
            'is_food_included' => $request->is_food_included,
            'gender_preference' => $request->gender_preference ?? $boarding->gender_preference,
            'wifi' => $request->wifi ?? $boarding->wifi,
            'parking' => $request->parking ?? $boarding->parking,
            'laundry' => $request->laundry ?? $boarding->laundry,
            'attached_bathroom' => $request->attached_bathroom ?? $boarding->attached_bathroom,
            'furnished' => $request->furnished ?? $boarding->furnished,
            'property_doc_image' => $boarding->property_doc_image,
            'police_report_image' => $boarding->police_report_image,
            'privacy_policy' => $request->privacy_policy ?? $boarding->privacy_policy,
            'posted_date' => $request->posted_date,
        ]);

        // Handle additional photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('boardings', 'public');
                $boarding->photos()->create([
                    'image_url' => $path,
                    'is_main' => false,
                ]);
            }
        }

        // Update main photo
        if ($request->main_photo) {
            RoomPhoto::where('boarding_id', $boarding->boarding_id)->update(['is_main' => false]);
            RoomPhoto::where('photo_id', $request->main_photo)->update(['is_main' => true]);
        }

        return redirect()->route('provider.boardings.index')->with('success', 'Boarding updated successfully!');
    }

    // Delete a boarding
    public function destroy($id)
    {
        $boarding = Boarding::where('user_id', Auth::id())->findOrFail($id);

        // Delete photos from storage
        foreach ($boarding->photos as $photo) {
            Storage::disk('public')->delete($photo->image_url);
            $photo->delete();
        }

        Storage::disk('public')->delete([$boarding->property_doc_image, $boarding->police_report_image]);
        $boarding->delete();

        return redirect()->route('provider.boardings.index')->with('success', 'Boarding deleted successfully!');
    }

    // Delete a single photo
    public function deletePhoto($id)
    {
        $photo = RoomPhoto::findOrFail($id);
        Storage::disk('public')->delete($photo->image_url);
        $photo->delete();

        return back()->with('success', 'Photo deleted successfully!');
    }

   public function show($id)
{
    // Fetch the boarding with its photos and provider
    $boarding = Boarding::with(['photos', 'user'])->findOrFail($id);

    // Return view
    return view('pages.provider-details', [
        'boarding' => $boarding,       // boarding details
        'provider' => $boarding->user, // provider details
    ]);
}
public function bookNow($boardingId)
{
    $boarding = Boarding::findOrFail($boardingId);

    // 40% of the first rent increases trust score
    $trustIncrease = $boarding->monthly_rent * 0.4;
    $boarding->trust_score += $trustIncrease;
    $boarding->save();

    // Redirect or show confirmation
    return redirect()->route('boarding.details', $boarding->boarding_id)
                     ->with('success', 'Booking confirmed! Trust score increased.');
}

public function search(Request $request)
{
    $query = $request->input('q');

    $boardings = Boarding::where('title', 'like', "%$query%")
                ->orWhere('location', 'like', "%$query%")
                ->get();

    return view('boardings.index', compact('boardings'));
}


}
