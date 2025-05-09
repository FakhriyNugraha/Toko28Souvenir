<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Produk;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PembeliController extends Controller
{
    public function beranda(Request $request)
    {
        // Ambil query pencarian jika ada
        $search = $request->input('search');
    
        // Ambil data produk dari database dengan pencarian jika ada
        $produks = DB::table('produks')
            ->join('kategoris', 'produks.kategori_id', '=', 'kategoris.id')
            ->select('produks.id', 'produks.nama_produk', 'produks.jumlah_stok', 'produks.harga', 'kategoris.nama as kategori');
    
        // Jika ada input pencarian, filter produk berdasarkan nama_produk
        if ($search) {
            $produks = $produks->where('produks.nama_produk', 'like', '%' . $search . '%');
        }
    
        // Ambil produk
        $produks = $produks->get();
    
        // Ambil data pembeli yang sedang login
        $pembeli = Pembeli::find(session('pembeli_id')); // Mengambil ID pembeli dari session
    
        // Kirim data pembeli dan produk ke view
        return view('pembeli.beranda', compact('produks', 'pembeli'));
    }
    

    public function showProfile()
{
    // Ambil data pembeli yang sedang login
    $pembeli = Pembeli::find(session('pembeli_id')); // Mengambil ID pembeli dari session

    return view('pembeli.profil', compact('pembeli')); // Kirim data pembeli ke view
}

public function profil()
{
    // Mengambil data pembeli berdasarkan ID yang ada di session
    $pembeli = Pembeli::find(session('pembeli_id'));

    // Kirim data pembeli ke view
    return view('pembeli.profil', compact('pembeli'));
}

public function editProfil()
{
    // Ambil data pembeli yang sedang login
    $pembeli = Pembeli::find(session('pembeli_id'));

    // Tampilkan halaman edit profil
    return view('pembeli.editprofil', compact('pembeli'));
}

public function updateProfil(Request $request)
{
    // Validasi input
    $request->validate([
        'namapengguna' => 'required',
        'katasandi' => 'nullable|min:3',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Ambil data pembeli yang sedang login
    $pembeli = Pembeli::find(session('pembeli_id'));

    // Cek jika ada foto baru
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $fotoPath = time() . '_' . $foto->getClientOriginalName();
        $foto->move(public_path(''), $fotoPath); // Menyimpan file di public/storage
        $pembeli->foto = '' . $fotoPath; // Menyimpan path foto baru ke database
    }

    // Jika kata sandi diisi, maka perbarui kata sandi
    if ($request->filled('katasandi')) {
        $pembeli->katasandi = Hash::make($request->katasandi);
    }

    // Perbarui nama pengguna
    $pembeli->namapengguna = $request->namapengguna;

    // Simpan perubahan
    $pembeli->save();

    // Redirect ke halaman profil pembeli dengan pesan sukses
    return redirect()->route('pembeli.profil')->with('success', 'Profil berhasil diperbarui.');
}


}
