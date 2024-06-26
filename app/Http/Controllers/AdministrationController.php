<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemId;

class AdministrationController extends Controller
{
    public function index()
    {
        $items = ItemId::with('group')->orderBy('groupid')->get();
        return view('administration.items.index', compact('items'));
    }

    public function show($groupid)
    {
        $items = ItemId::with('group')->where('groupid', $groupid)->get();
        if ($items->isEmpty()) {
            abort(404);
        }
        return view('administration.items.show', compact('items'));
    }

    public function showAll()
    {
        $items = ItemId::with('group')->orderBy('groupid')->get();
        return view('administration.items.showall', compact('items'));
    }

    public function updateStatus(Request $request, $id)
    {
        $item = ItemId::findOrFail($id);
        $item->status = $request->input('status');
        $item->save();

        return redirect()->back()->with('status', 'Item status updated successfully!');
    }

    public function updateName(Request $request, $id)
    {
        $item = ItemId::findOrFail($id);
        $item->name = $request->input('name');
        $item->save();

        return redirect()->back()->with('status', 'Item name updated successfully!');
    }
}
