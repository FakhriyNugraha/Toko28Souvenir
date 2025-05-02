@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <center><h1><b>EDIT DATAMU</b></h1></center>
            <form action="/lamanutama/{{$lamanutama->id}}" method="post">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="name">NAMA PRODUK</label>
                    <input class="form-control" type="text" name="nama_produk" id="nama_produk" value="{{$lamanutama->nama_produk}}">
                </div>
                <div class="mb-3">
                    <label for="name">Jumlah Stok</label>
                    <input class="form-control" type="number" name="jumlah_stok" id="jumlah_stok" value="{{$lamanutama->jumlah_stok}}">
                </div>
                <div class="mb-3">
                    <label for="name">Harga</label>
                    <input class="form-control" type="text" name="harga" id="harga" value="{{$lamanutama->harga}}">
                </div>
                <div class="mb-3">
                    <label for="name">Kategori</label>
                    <select class="form-select" name="kategori_id" id="kategori_id">
                        @foreach ($kategori as $k)
                            <option value="{{$k->id}}" {{$lamanutama->kategori_id == $k->id ? 'selected' : ''}}>{{$k->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-danger" type="submit">SUBMIT</button>
            </form>
        </div>
    </div>
@endsection