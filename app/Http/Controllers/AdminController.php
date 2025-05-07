<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\akunadmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
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
