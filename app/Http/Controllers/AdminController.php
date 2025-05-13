<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\akunadmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Pembeli;
use Carbon\Carbon;

class AdminController extends Controller
{
  
    
    public function beranda()
    {
        // Total produk
        $jumlah_produk = Produk::count();
        
        // Produk dengan stok rendah (kurang dari 5)
        $produk_stok_rendah = Produk::where('jumlah_stok', '<', 5)->count();
        
        // Total transaksi
        $total_pesanan = Transaksi::count();
        
        // Pesanan yang perlu diproses (status 'proses')
        $pesanan_proses = Transaksi::where('status', 'proses')->count();
        
        // Total pendapatan dari transaksi selesai
        $total_pendapatan = Transaksi::where('status', 'selesai')->sum('total_harga');
        
        // Transaksi terakhir
        $transaksi_terakhir = Transaksi::latest()->first();
        
        // 5 transaksi terbaru untuk aktivitas terkini
        $aktivitas = Transaksi::orderBy('created_at', 'desc')
                        ->limit(5)
                        ->get();

        return view('admin.beranda', compact(
            'jumlah_produk',
            'produk_stok_rendah',
            'total_pesanan',
            'pesanan_proses',
            'total_pendapatan',
            'transaksi_terakhir',
            'aktivitas'
        ));
    }


    // Menampilkan profil admin
    public function profil()
    {
        // Ambil ID admin yang sedang login dari sesi
        $admin_id = session('admin_id');
        
        // Ambil data admin berdasarkan ID dari sesi
        $admin = DB::table('akunadmins')->where('id', $admin_id)->first();
    
        return view('admin.profil', compact('admin'));
    }
    

    public function editprofil()
    {
        // Ambil ID admin yang sedang login dari sesi
        $admin_id = session('admin_id');
    
        // Ambil data admin berdasarkan ID dari sesi
        $admin = DB::table('akunadmins')->where('id', $admin_id)->first();
    
        // Kirim data admin ke view untuk diedit
        return view('admin.editprofil', compact('admin'));
    }
    
    public function updateprofil(Request $request)
    {
        // Validasi input
        $request->validate([
            'namapengguna' => 'required',
            'katasandi' => 'nullable|min:3',
        ]);
    
        // Ambil ID admin yang sedang login dari sesi
        $admin_id = session('admin_id');
    
        // Ambil data admin berdasarkan ID dari sesi
        $admin = DB::table('akunadmins')->where('id', $admin_id)->first();
    
        // Update data admin, pastikan hanya admin yang sedang login yang bisa mengubah datanya
        DB::table('akunadmins')->where('id', $admin_id)->update([
            'namapengguna' => $request->namapengguna,
            'katasandi' => $request->katasandi ? bcrypt($request->katasandi) : $admin->katasandi, // Update kata sandi jika diubah
        ]);
    
        // Kirim pesan sukses setelah update
        return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui!');
    }
    
}
