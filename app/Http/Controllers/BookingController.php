<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Item;
use App\Helpers\UserHelper;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_id' => 'nullable|exists:item_id,id',
            'item_name' => 'nullable|string',
            'user_id' => 'nullable|integer|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Use the user ID from the request or fallback to the authenticated user ID or default to 3
        $userId = $request->input('user_id', UserHelper::getUserId());

        try {
            Booking::createBooking($validatedData, $userId);
            return response()->json(['message' => 'Booking created successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
