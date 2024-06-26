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

    public function show($groupid, Request $request)
    {
        $thisMonth = $request->query('thismonth', Carbon::now()->month);
        $thisYear = $request->query('thisyear', Carbon::now()->year);

        // Ensure we are fetching the correct item
        $item = Item::where('groupid', $groupid)->firstOrFail();

        $items = Item::where('groupid', $groupid)->get();

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

    public function updateStatus(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->status = $request->input('status');
        $item->save();

        return redirect()->back()->with('status', 'Item status updated successfully!');
    }

    public function updateName(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->name = $request->input('name');
        $item->save();

        return redirect()->back()->with('status', 'Item name updated successfully!');
    }
}



