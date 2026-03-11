<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // GET /api/pesanans
    public function index(Request $request)
    {
        $pesanans = Pesanan::with(['user', 'layanan', 'pembayaran'])
            ->where('User_ID', $request->user()->User_ID)
            ->get();

        return response()->json($pesanans);
    }

    // POST /api/pesanans
    public function store(Request $request)
    {
        $request->validate([
            'Layanan_ID'       => 'required|exists:layanans,Layanan_ID',
            'Status'           => 'required|string',
            'Tanggal_pesanan'  => 'required|date',
            'Total_harga'      => 'required|numeric|min:0',
            'Keterangan'       => 'nullable|string',
        ]);

        $pesanan = Pesanan::create([
            'Layanan_ID'      => $request->Layanan_ID,
            'User_ID'         => $request->user()->User_ID,
            'Status'          => $request->Status,
            'Tanggal_pesanan' => $request->Tanggal_pesanan,
            'Total_harga'     => $request->Total_harga,
            'Keterangan'      => $request->Keterangan,
        ]);

        return response()->json([
            'message' => 'Pesanan berhasil dibuat',
            'data'    => $pesanan->load(['layanan', 'pembayaran']),
        ], 201);
    }

    // GET /api/pesanans/{id}
    public function show(Request $request, $id)
    {
        $pesanan = Pesanan::with(['user', 'layanan', 'pembayaran'])
            ->where('User_ID', $request->user()->User_ID)
            ->findOrFail($id);

        return response()->json($pesanan);
    }

    // PUT /api/pesanans/{id}
    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::where('User_ID', $request->user()->User_ID)->findOrFail($id);

        $request->validate([
            'Layanan_ID'      => 'sometimes|exists:layanans,Layanan_ID',
            'Status'          => 'sometimes|required|string',
            'Tanggal_pesanan' => 'sometimes|required|date',
            'Total_harga'     => 'sometimes|required|numeric|min:0',
            'Keterangan'      => 'nullable|string',
        ]);

        $pesanan->update($request->only(
            'Layanan_ID', 'Status', 'Tanggal_pesanan', 'Total_harga', 'Keterangan'
        ));

        return response()->json([
            'message' => 'Pesanan berhasil diperbarui',
            'data'    => $pesanan->load(['layanan', 'pembayaran']),
        ]);
    }

    // DELETE /api/pesanans/{id}
    public function destroy(Request $request, $id)
    {
        $pesanan = Pesanan::where('User_ID', $request->user()->User_ID)->findOrFail($id);
        $pesanan->delete();

        return response()->json(['message' => 'Pesanan berhasil dihapus']);
    }
}
