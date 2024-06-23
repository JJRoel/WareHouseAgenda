<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ItemController extends Controller
{
    public function index()
    {
        // Fetch unique item names
        $items = Item::select('name')->distinct()->get();
        return view('items.index', compact('items'));
    }

    public function show($name, Request $request)
    {
        // Fetch item details by name
        $item = Item::where('name', $name)->firstOrFail();

        // Get the month and year from the request or use the current month and year
        $thisMonth = $request->get('thismonth', Carbon::now()->month);
        $thisYear = $request->get('thisyear', Carbon::now()->year);
        $monthName = Carbon::create($thisYear, $thisMonth, 1)->format('F');

        // Mock data for agenda items (replace with actual data fetching logic)
        $agendaItems = []; // Replace with actual fetching logic

        // Fetch items with the same name
        $items = Item::where('name', $name)->get();

        return view('items.show', compact('item', 'thisMonth', 'thisYear', 'monthName', 'agendaItems', 'items'));
    }
}







