@extends('layouts.app')

@section('content')

<center><h1 class="mb-5">Daftar Souvenir</h1></center>
@if (@session()->has('success'))
  <div class="alert alert-success">
    {{session('success')}}
  </div>
@endif

<a href="/lamanutama/lamancreate" class="btn btn-primary mb-2">+Tambah Data</a>
<table class="table table-dark table-striped">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Produk</th>
        <th scope="col">Jumlah Stok</th>
        <th scope="col">Harga</th>
        <th scope="col">Kategori</th>
        <th>Aksi</th>
      </tr>
    </thead>
    @foreach ($lamanutamas as $a)
      <tbody>
        <tr>
          <th scope="row">{{$loop->iteration}}</th>
          <td>{{$a->nama_produk}}</td>
          <td>{{$a->jumlah_stok}}</td>
          <td>{{$a->harga}}</td>
          <td>{{ $a->kategori?->nama ?? '-' }}</td>
          <td>
            <a href="/lamanutama/{{$a->id}}/edit" class="btn btn-warning">Edit</a>
            <form action="/lamanutama/{{$a->id}}" method="post" class="d-inline">
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-danger" onclick="return confirm('Konfirmasi Hapus?')">Hapus</button>
            </form>
          </td>
        </tr>
      </tbody>
    @endforeach
  </table>
@endsection