<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembeli;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AutentikasiPembeliController extends Controller
{
    public function showLoginForm()
    {
        return view('pembeli.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'namapengguna' => 'required',
            'katasandi' => 'required'
        ]);

        $pembeli = Pembeli::where('namapengguna', $request->namapengguna)->first();

        if ($pembeli && Hash::check($request->katasandi, $pembeli->katasandi)) {
            Session::put('pembeli_id', $pembeli->id);
            Session::put('namapengguna', $pembeli->namapengguna);
            return redirect('/pembeli/beranda');
        }

        return back()->withErrors(['invalid' => 'Nama pengguna atau kata sandi salah']);
    }

    public function showRegisterForm()
    {
        return view('pembeli.daftar');
    }

    public function register(Request $request)
    {
        $request->validate([
            'namapengguna' => 'required|unique:pembelis',
            'katasandi' => 'required|min:6',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotopembeli', 'public');
        }

        Pembeli::create([
            'namapengguna' => $request->namapengguna,
            'katasandi' => Hash::make($request->katasandi),
            'foto' => $fotoPath
        ]);

        return redirect()->route('pembeli.login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }

    public function daftar(Request $request)
{
    $request->validate([
        'namapengguna' => 'required|unique:pembelis,namapengguna',
        'katasandi' => 'required|min:3',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $fotoPath = null;

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $namaFile = time() . '_' . $foto->getClientOriginalName();
        $foto->move(public_path('image'), $namaFile);
        $fotoPath = 'image/' . $namaFile; // Disimpan di kolom 'foto'
    }

    Pembeli::create([
        'namapengguna' => $request->namapengguna,
        'katasandi' => Hash::make($request->katasandi),
        'foto' => $fotoPath,
    ]);

    return redirect('/pembeli/masuk')->with('success', 'Pendaftaran berhasil, silakan login.');
}

public function formDaftar()
{
    return view('pembeli.daftar');
}


    public function logout()
    {
        Session::forget('pembeli_id');
        Session::forget('namapengguna');
        return redirect()->route('pembeli.login');
    }
}
