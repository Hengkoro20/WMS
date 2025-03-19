<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Menampilkan semua admin
    public function index()
    {
        $admins = Admin::all();
        return response()->json(['status' => 200, 'message' => 'Admins retrieved successfully.', 'data' => $admins], 200);
    }

    // Menyimpan admin baru
    public function store(Request $request)
    {
        $request->validate([
            'gmail' => 'required|email|unique:admins,gmail',
            'password' => 'required|min:6'
        ]);

        $admin = Admin::create([
            'gmail' => $request->gmail,
            'password' => Hash::make($request->password)
        ]);

        return response()->json(['status' => 201, 'message' => 'Admin created successfully.', 'data' => $admin], 201);
    }

    // Menampilkan admin berdasarkan ID
    public function show($id)
    {
        $admin = Admin::where('id_admin', $id)->first();
        if (!$admin) return response()->json(['status' => 404, 'message' => 'Admin not found.'], 404);

        return response()->json(['status' => 200, 'message' => 'Admin retrieved successfully.', 'data' => $admin], 200);
    }

    // Mengupdate data admin
    public function update(Request $request, $id)
    {
        $admin = Admin::where('id_admin', $id)->first();
        if (!$admin) return response()->json(['status' => 404, 'message' => 'Admin not found.'], 404);

        $request->validate([
            'gmail' => 'email|unique:admins,gmail,' . $id . ',id_admin', // Perbaiki validasi unique
            'password' => 'nullable|min:6'
        ]);

        if ($request->has('gmail')) {
            $admin->gmail = $request->gmail;
        }

        if ($request->has('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return response()->json(['status' => 200, 'message' => 'Admin updated successfully.', 'data' => $admin], 200);
    }

    // Menghapus admin
    public function destroy($id)
    {
        $admin = Admin::where('id_admin', $id)->first();
        if (!$admin) {
            return response()->json(['status' => 404, 'message' => 'Admin not found'], 404);
        }

        $admin->delete();
        return response()->json(['status' => 200, 'message' => 'Admin deleted successfully.'], 200);
    }
}
