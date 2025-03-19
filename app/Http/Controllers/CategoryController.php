<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Mendapatkan semua kategori
    public function index()
{
    $categories = Category::all();

    return response()->json([
        'status' => 200,
        'message' => 'Categories retrieved successfully.',
        'data' => $categories
    ], 200);
}


    // Menambahkan kategori baru
    public function store(Request $request) {
        $request->validate(['name' => 'required|string|max:255']);
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    // Mendapatkan detail kategori
    public function show($id) {
        $category = Category::find($id);
        if (!$category) return response()->json(['message' => 'Category not found'], 404);
        return response()->json($category, 200);
    }

    // Memperbarui kategori
    public function update(Request $request, $id) {
        $category = Category::find($id);
        if (!$category) return response()->json(['message' => 'Category not found'], 404);

        $request->validate(['name' => 'required|string|max:255']);
        $category->update($request->all());
        return response()->json($category, 200);
    }

    // Menghapus kategori
    public function destroy($id) {
        $category = Category::find($id);
        if (!$category) return response()->json(['message' => 'Category not found'], 404);

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
