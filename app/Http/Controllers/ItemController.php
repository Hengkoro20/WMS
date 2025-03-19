<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
{
    $items = Item::all();

    return response()->json([
        'status' => 200,
        'message' => 'Categories retrieved successfully.',
        'data' => $items
    ], 200);
}

    public function store(Request $request)
    {
        $request->validate([
            'Item_name' => 'required|string|max:255',
            'id_category' => 'required|exists:categories,id',
            'stock' => 'required|integer'
        ]);

        $item = Item::create($request->all());
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Item::with('category')->find($id);

        if (!$item) return response()->json(['message' => 'Item not found'], 404);

        return response()->json($item, 200);
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        if (!$item) return response()->json(['message' => 'Item not found'], 404);

        $request->validate([
            'Item_name' => 'string|max:255',
            'id_category' => 'exists:categories,id',
            'stock' => 'integer'
        ]);

        $item->update($request->all());
        return response()->json($item, 200);
    }

    public function destroy($id)
    {
        $item = Item::find($id);

        if (!$item) return response()->json(['message' => 'Item not found'], 404);

        $item->delete();
        return response()->json(['message' => 'Item deleted successfully'], 200);
    }
}
