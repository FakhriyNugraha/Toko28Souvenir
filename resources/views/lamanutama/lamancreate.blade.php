@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <center><h1><b>MASUKKAN DATA PRODUK</b></h1></center>
            <form action="/lamanutama" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name">Nama Produk</label>
                    <input class="form-control" type="text" name="nama_produk" id="nama_produk">
                </div>
                <div class="mb-3">
                    <label for="name">Jumlah Stok</label>
                    <input class="form-control" type="number" name="jumlah_stok" id="jumlah_stok">
                </div>
                <div class="mb-3">
                    <label for="name">Harga</label>
                    <input class="form-control" type="text" name="harga" id="harga">
                </div>
                <div class="mb-3">
                    <label for="name">Kategori</label>
                    <select class="form-select" name="kategori_id" id="kategori_id">
                        @foreach ($kategoris as $k)
                            <option value="{{$k->id}}">{{$k->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-danger" type="submit">SUBMIT</button>
            </form>
        </div>
    </div>
@endsection