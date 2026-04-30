<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananAdminController extends Controller
{
    /**
     * Tampilkan daftar layanan di halaman admin.
     */
    public function index()
    {
        $layanans = Layanan::all();
        $total = $layanans->count();
        
        return view('LayananAdmin', compact('layanans', 'total'));
    }

    /**
     * Tampilkan formulir untuk menambah layanan baru.
     */
    public function create()
    {
        // Mengirim objek Layanan kosong agar form tidak error saat mencoba membaca properti
        return view('LayananForm', ['mode' => 'tambah', 'layanan' => new Layanan]);
    }

    /**
     * Simpan data layanan baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Ubah teks fitur yang dipisah koma menjadi array
        $request->merge([
            'fitur' => array_map('trim', explode(',', $request->fitur_input))
        ]);

        // 2. Validasi input
        $data = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'tagline'      => 'required|string|max:255',
            'ikon'         => 'required|string',
            'harga'        => 'required|string',
            'fitur'        => 'required|array',
        ]);

        // 3. Set nilai highlight (true jika dicentang, false jika tidak)
        $data['is_highlight'] = $request->has('is_highlight');

        // 4. Simpan ke database
        Layanan::create($data);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan baru berhasil ditambahkan!');
    }

    /**
     * Tampilkan formulir untuk mengedit layanan yang sudah ada.
     */
    public function edit($id)
    {
        // Cari data berdasarkan Primary Key, akan menghasilkan error 404 jika tidak ditemukan
        $layanan = Layanan::findOrFail($id);
        
        return view('LayananForm', ['mode' => 'edit', 'layanan' => $layanan]);
    }

    /**
     * Simpan perubahan layanan ke database.
     */
    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        // 1. Ubah teks fitur yang dipisah koma menjadi array dan bersihkan spasi
        $request->merge([
            'fitur' => array_map('trim', explode(',', $request->fitur_input))
        ]);

        // 2. Validasi input yang masuk
        $data = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'tagline'      => 'required|string|max:255',
            'ikon'         => 'required|string',
            'harga'        => 'required|string',
            'fitur'        => 'required|array',
        ]);

       

        // 4. Eksekusi update data
        $layanan->update($data);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    /**
     * Hapus layanan dari database.
     */
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->back()->with('success', 'Layanan berhasil dihapus dari sistem.');
    }
}