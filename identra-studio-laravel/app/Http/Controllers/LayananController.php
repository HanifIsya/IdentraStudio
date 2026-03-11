<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    // GET /api/layanans
    public function index()
    {
        $layanans = Layanan::all();
        return response()->json($layanans);
    }

    // POST /api/layanans
    public function store(Request $request)
    {
        $request->validate([
            'Nama_layanan' => 'required|string',
            'Kategori'     => 'required|string',
        ]);

        $layanan = Layanan::create($request->only('Nama_layanan', 'Kategori'));

        return response()->json([
            'message' => 'Layanan berhasil ditambahkan',
            'data'    => $layanan,
        ], 201);
    }

    // GET /api/layanans/{id}
    public function show($id)
    {
        $layanan = Layanan::findOrFail($id);
        return response()->json($layanan);
    }

    // PUT /api/layanans/{id}
    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $request->validate([
            'Nama_layanan' => 'sometimes|required|string',
            'Kategori'     => 'sometimes|required|string',
        ]);

        $layanan->update($request->only('Nama_layanan', 'Kategori'));

        return response()->json([
            'message' => 'Layanan berhasil diperbarui',
            'data'    => $layanan,
        ]);
    }

    // DELETE /api/layanans/{id}
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return response()->json(['message' => 'Layanan berhasil dihapus']);
    }
}
