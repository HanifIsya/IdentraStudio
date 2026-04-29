<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Menampilkan daftar layanan untuk sisi User (Blade View).
     */
    public function index()
    {
        // Mengambil semua data layanan dari database
        $layanans = Layanan::all();

        // Mengirim data ke view LayananUser.blade.php
        return view('LayananUser', compact('layanans'));
    }

    /**
     * Menyimpan layanan baru (Bisa digunakan oleh Admin nanti).
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'tagline'      => 'required|string|max:255',
            'ikon'         => 'required|string', // Contoh: fa-desktop
            'fitur'        => 'required|array',  // Dikirim sebagai array dari form
            'harga'        => 'required|string',
            'is_highlight' => 'boolean',
        ]);

        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'tagline'      => $request->tagline,
            'ikon'         => $request->ikon,
            'fitur'        => $request->fitur,
            'harga'        => $request->harga,
            'is_highlight' => $request->is_highlight ?? false,
        ]);

        return redirect()->back()->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail layanan tertentu (Jika dibutuhkan).
     */
    public function show($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('LayananDetail', compact('layanan'));
    }

    /**
     * Memperbarui data layanan.
     */
    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $request->validate([
            'nama_layanan' => 'sometimes|required|string',
            'tagline'      => 'sometimes|required|string',
            'fitur'        => 'sometimes|required|array',
            'harga'        => 'sometimes|required|string',
        ]);

        $layanan->update($request->all());

        return redirect()->back()->with('success', 'Layanan berhasil diperbarui!');
    }

    /**
     * Menghapus layanan.
     */
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->back()->with('success', 'Layanan berhasil dihapus!');
    }
}