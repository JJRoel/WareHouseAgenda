<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Item;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_id' => 'nullable|exists:item_id,id',
            'item_name' => 'required_without:item_id|string|exists:item_id,name',
            'user_id' => 'required|integer|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Check if item_id is provided
        if (isset($validatedData['item_id'])) {
            // Check if the specific item is already booked
            $isBooked = Booking::where('item_id', $validatedData['item_id'])
                ->where(function ($query) use ($validatedData) {
                    $query->whereBetween('start_date', [$validatedData['start_date'], $validatedData['end_date']])
                          ->orWhereBetween('end_date', [$validatedData['start_date'], $validatedData['end_date']])
                          ->orWhere(function ($query) use ($validatedData) {
                              $query->where('start_date', '<=', $validatedData['start_date'])
                                    ->where('end_date', '>=', $validatedData['end_date']);
                          });
                })->exists();

            if ($isBooked) {
                return response()->json(['message' => 'This item is already claimed for the selected dates.'], 422);
            }
        } else {
            // Find an available item with the same name
            $availableItem = Item::where('name', $validatedData['item_name'])
                ->whereDoesntHave('bookings', function ($query) use ($validatedData) {
                    $query->whereBetween('start_date', [$validatedData['start_date'], $validatedData['end_date']])
                          ->orWhereBetween('end_date', [$validatedData['start_date'], $validatedData['end_date']])
                          ->orWhere(function ($query) use ($validatedData) {
                              $query->where('start_date', '<=', $validatedData['start_date'])
                                    ->where('end_date', '>=', $validatedData['end_date']);
                          });
                })->first();

            if (!$availableItem) {
                return response()->json(['message' => 'No available items for the selected dates.'], 422);
            }

            $validatedData['item_id'] = $availableItem->id;
        }

        Booking::create($validatedData);

        return response()->json(['message' => 'Booking created successfully'], 200);
    }
}
