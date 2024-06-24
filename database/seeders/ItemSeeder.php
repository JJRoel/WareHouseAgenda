<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function show($name, Request $request)
    {
        $thisMonth = $request->query('thismonth', \Carbon\Carbon::now()->month);
        $thisYear = $request->query('thisyear', \Carbon\Carbon::now()->year);

        $item = Item::where('name', $name)->firstOrFail();
        $items = Item::where('name', $name)->get();

        $agendaItems = \App\Models\Booking::whereYear('start_date', $thisYear)
            ->whereMonth('start_date', $thisMonth)
            ->where('item_id', $item->id)
            ->get();

        $userBookings = \App\Models\Booking::whereYear('start_date', $thisYear)
            ->whereMonth('start_date', $thisMonth)
            ->where('user_id', 2) // Change this to the authenticated user id
            ->orderBy('start_date') // Order by start_date
            ->get();

        $monthName = \Carbon\Carbon::create($thisYear, $thisMonth)->format('F');

        return view('items.show', compact('item', 'items', 'agendaItems', 'userBookings', 'thisMonth', 'thisYear', 'monthName'));
    }
}
