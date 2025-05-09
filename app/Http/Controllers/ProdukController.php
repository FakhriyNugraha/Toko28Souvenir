<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\produk;

class ProdukController extends Controller
{

    
    public function index(Request $request)
    {
        // Ambil query pencarian jika ada
        $search = $request->input('search');
        
        // Ambil data produk dari database, dengan pencarian jika ada
        $query = DB::table('produks')
            ->join('kategoris', 'produks.kategori_id', '=', 'kategoris.id')
            ->select('produks.id', 'produks.nama_produk', 'produks.jumlah_stok', 'produks.harga', 'kategoris.nama as kategori');

        // Jika ada input pencarian, filter produk berdasarkan nama_produk
        if ($search) {
            $query->where('produks.nama_produk', 'like', '%' . $search . '%');
        }

        // Ambil data produk sesuai dengan filter atau tanpa filter jika tidak ada pencarian
        $produks = $query->get();

        return view('admin.produk', compact('produks'));
    }
    public function show($id)
    {
        // Ambil data produk berdasarkan ID
        $produk = DB::table('produks')
            ->join('kategoris', 'produks.kategori_id', '=', 'kategoris.id')
            ->select('produks.id', 'produks.nama_produk', 'produks.jumlah_stok', 'produks.harga', 'produks.kategori_id', 'kategoris.nama as kategori')
            ->where('produks.id', $id)
            ->first();
    
        // Ambil data kategori untuk dropdown
        $kategoris = DB::table('kategoris')->get();
    
        return view('admin.edit_produk', compact('produk', 'kategoris'));
    }
    

    public function create()
{
    // Ambil data kategori untuk dropdown
    $kategoris = DB::table('kategoris')->get();

    // Tampilkan halaman create produk dengan data kategori
    return view('admin.produk_create', compact('kategoris'));
}



public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama_produk' => 'required',
        'jumlah_stok' => 'required|numeric',
        'harga' => 'required|numeric',
        'kategori_id' => 'required|exists:kategoris,id', // Pastikan nama tabel 'kategoris' benar
    ]);

    // Simpan produk baru ke dalam database
    DB::table('produks')->insert([
        'nama_produk' => $request->nama_produk,
        'jumlah_stok' => $request->jumlah_stok,
        'harga' => $request->harga,
        'kategori_id' => $request->kategori_id,
    ]);

    return redirect()->route('admin.produk')->with('success', 'Produk berhasil ditambahkan');
}

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required',
            'jumlah_stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id', // pastikan nama tabelnya benar 'kategoris'
        ]);

        // Update data produk
        DB::table('produks') // pastikan nama tabelnya benar 'produks'
            ->where('id', $id)
            ->update([
                'nama_produk' => $request->nama_produk,
                'jumlah_stok' => $request->jumlah_stok,
                'harga' => $request->harga,
                'kategori_id' => $request->kategori_id,
            ]);

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Hapus produk
        DB::table('produks') // pastikan nama tabelnya benar 'produks'
            ->where('id', $id)
            ->delete();

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil dihapus');
    }
}
