<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        $kategoris = Kategori::all(); // Ambil semua kategori dari tabel kategori
        return view('admin.kategori', compact('kategoris'));
    }

    // Menampilkan form untuk menambah kategori baru
    public function create()
    {
        return view('admin.create_kategori');
    }

    // Menyimpan kategori baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255', // Validasi input nama kategori
        ]);

        Kategori::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id); // Menemukan kategori berdasarkan ID
        return view('admin.edit_kategori', compact('kategori'));
    }

    // Memperbarui kategori di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255', // Validasi input nama kategori
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil diperbarui!');
    }

    // Menghapus kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete(); // Menghapus kategori

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil dihapus!');
    }
}
