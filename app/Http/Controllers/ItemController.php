<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Booking;
use Carbon\Carbon;
use App\Helpers\UserHelper;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function show($name, Request $request)
    {
        $thisMonth = $request->query('thismonth', Carbon::now()->month);
        $thisYear = $request->query('thisyear', Carbon::now()->year);

        $item = Item::where('name', $name)->firstOrFail();
        $items = Item::where('name', $name)->get();

        $agendaItems = Booking::whereYear('start_date', $thisYear)
            ->whereMonth('start_date', $thisMonth)
            ->where('item_id', $item->id)
            ->get();

        $userId = UserHelper::getUserId(); // Use the helper method to get the user ID

        $userBookings = Booking::whereYear('start_date', $thisYear)
            ->whereMonth('start_date', $thisMonth)
            ->where('user_id', $userId) // Use the correct user ID
            ->orderBy('start_date') // Order by start_date
            ->get();

        $monthName = Carbon::create($thisYear, $thisMonth)->format('F');

        return view('items.show', compact('item', 'items', 'agendaItems', 'userBookings', 'thisMonth', 'thisYear', 'monthName'));
    }
}
