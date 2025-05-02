<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\lamanutama;
use App\Models\kategori;


class lamanutamaController extends Controller

{
    public function index()
    {
        return view('lamanutama.lamanutama', [
            'lamanutamas' => lamanutama::all(),
        ]);
    }
    public function create(){
        return view('lamanutama.lamancreate', [
            'kategoris' => kategori::all(),
        ]);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'nama_produk' => 'required',
            'jumlah_stok' => 'required',
            'harga' => 'required',
            'kategori_id' => 'required'
        ]);


     //ngambil apa yg diinput user di name form
        lamanutama::create([
        'nama_produk' => $request->nama_produk,
        'jumlah_stok' => $request->jumlah_stok,
        'harga' => $request->harga,
        'kategori_id' => $request->kategori_id
    ]);

    return redirect('/lamanutama')->with('success', 'Data Berhasil Disimpan');

}

public function destroy($id){
    $lamanutamas = lamanutama::find($id);
    $lamanutamas ->delete();
    return redirect('/lamanutama')->with('success', 'Data Berhasil dihapus');
}

public function edit($id){
    return view("lamanutama.lamanutamaedit", [
        "lamanutama" => lamanutama::find($id),
        "kategori" => kategori::all()
    ]);
}

public function update(Request $request, $id){
        $validated = $request->validate([
            'nama_produk' => 'required',
            'jumlah_stok' => 'required',
            'harga' => 'required',
            'kategori_id' => 'required'
        ]);
        
        $lamanutama = lamanutama::find($id);

        $lamanutama->update([
            'nama_produk' => $request->nama_produk,
            'jumlah_stok' => $request->jumlah_stok,
            'harga' => $request->harga,
            'kategori_id' => $request->kategori_id
        ]);

        return redirect('/lamanutama')->with('success', 'Ubah Data Berhasil Diupdate');
    }

}

