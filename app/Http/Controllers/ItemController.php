<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // Mengambil semua data
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Item::all()
        ]);
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'required|integer'
        ]);

        $item = Item::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Item berhasil dibuat',
            'data' => $item
        ], 201);
    }

    // Menampilkan detail satu data
    public function show($id)
    {
        $item = Item::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $item
        ]);
    }

    // Mengupdate data
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string',
            'quantity' => 'sometimes|integer',
            'price' => 'sometimes|numeric',
            'category_id' => 'sometimes|integer'
        ]);

        $item->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Item berhasil diupdate',
            'data' => $item
        ]);
    }

    // Menghapus data
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Item berhasil dihapus'
        ]);
    }
}