<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemId;

class AdministrationController extends Controller
{
    public function index()
    {
        $items = ItemId::all();
        return view('administration.items.index', compact('items'));
    }

    public function show($name)
    {
        $items = ItemId::where('name', $name)->get();
        if ($items->isEmpty()) {
            abort(404);
        }
        return view('administration.items.show', compact('items'));
    }

    public function showall()
    {
        $items = ItemId::all();
        return view('administration.items.showall', compact('items'));
    }

    public function updateStatus(Request $request, $id)
    {
        $item = ItemId::findOrFail($id);
        $item->status = $request->input('status');
        $item->save();

        return redirect()->back()->with('status', 'Item status updated successfully!');
    }
}






