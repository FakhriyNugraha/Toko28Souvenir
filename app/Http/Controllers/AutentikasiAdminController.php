<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;

class AutentikasiAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.lamanlogin'); // gunakan view login yang sudah dibuat
    }

    public function masuk(Request $request)
    {
        $request->validate([
            'namapengguna' => 'required',
            'katasandi' => 'required',
        ]);

        $admin = DB::table('akunadmin')
            ->where('namapengguna', $request->namapengguna)
            ->where('katasandi', $request->katasandi)
            ->first();

        if ($admin) {
            Session::put('admin_logged_in', true);
            Session::put('namapengguna', $admin->namapengguna);
            return redirect('/admin/beranda');
        } else {
            return back()->withErrors(['invalid' => 'Nama pengguna atau kata sandi salah.']);
        }
    }

    public function keluar()
    {
        Session::flush();
        return redirect('/admin/masuk');
    }
}
