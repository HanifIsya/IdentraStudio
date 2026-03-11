<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // GET /api/pembayarans
    public function index(Request $request)
    {
        $pembayarans = Pembayaran::with('pesanan')
            ->whereHas('pesanan', function ($q) use ($request) {
                $q->where('User_ID', $request->user()->User_ID);
            })
            ->get();

        return response()->json($pembayarans);
    }

    // POST /api/pembayarans
    public function store(Request $request)
    {
        $request->validate([
            'Pesanan_ID'    => 'required|exists:pesanans,Pesanan_ID',
            'Metode_bayar'  => 'required|string',
            'Tanggal_bayar' => 'required|date',
            'Status_bayar'  => 'required|boolean',
        ]);

        // Pastikan pesanan milik user yang login
        $pesanan = Pesanan::where('User_ID', $request->user()->User_ID)
            ->findOrFail($request->Pesanan_ID);

        $pembayaran = Pembayaran::create([
            'Pesanan_ID'    => $pesanan->Pesanan_ID,
            'Metode_bayar'  => $request->Metode_bayar,
            'Tanggal_bayar' => $request->Tanggal_bayar,
            'Status_bayar'  => $request->Status_bayar,
        ]);

        // Update Pesanan dengan Pembayaran_ID
        $pesanan->update(['Pembayaran_ID' => $pembayaran->Pembayaran_ID]);

        return response()->json([
            'message' => 'Pembayaran berhasil dibuat',
            'data'    => $pembayaran->load('pesanan'),
        ], 201);
    }

    // GET /api/pembayarans/{id}
    public function show(Request $request, $id)
    {
        $pembayaran = Pembayaran::with('pesanan')
            ->whereHas('pesanan', function ($q) use ($request) {
                $q->where('User_ID', $request->user()->User_ID);
            })
            ->findOrFail($id);

        return response()->json($pembayaran);
    }

    // PUT /api/pembayarans/{id}
    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::whereHas('pesanan', function ($q) use ($request) {
            $q->where('User_ID', $request->user()->User_ID);
        })->findOrFail($id);

        $request->validate([
            'Metode_bayar'  => 'sometimes|required|string',
            'Tanggal_bayar' => 'sometimes|required|date',
            'Status_bayar'  => 'sometimes|required|boolean',
        ]);

        $pembayaran->update($request->only('Metode_bayar', 'Tanggal_bayar', 'Status_bayar'));

        return response()->json([
            'message' => 'Pembayaran berhasil diperbarui',
            'data'    => $pembayaran,
        ]);
    }

    // DELETE /api/pembayarans/{id}
    public function destroy(Request $request, $id)
    {
        $pembayaran = Pembayaran::whereHas('pesanan', function ($q) use ($request) {
            $q->where('User_ID', $request->user()->User_ID);
        })->findOrFail($id);

        $pembayaran->delete();

        return response()->json(['message' => 'Pembayaran berhasil dihapus']);
    }
}
