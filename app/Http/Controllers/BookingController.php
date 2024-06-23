<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_id' => 'required|exists:items,id',
            'user_id' => 'required|integer|exists:users,id', // assuming you have a users table
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Booking::create($validatedData);

        return response()->json(['message' => 'Booking created successfully'], 200);
    }
}