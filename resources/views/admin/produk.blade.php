<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-pink-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md h-screen">
        <div class="p-6 text-pink-600 text-2xl font-bold border-b">Toko28Souvenir</div>
        <nav class="mt-6">
            <a href="{{ route('admin.beranda') }}" class="block py-3 px-6 text-pink-700 hover:bg-pink-100">Beranda</a>
            <a href="{{ route('admin.produk') }}" class="block py-3 px-6 text-pink-700 hover:bg-pink-100">Produk</a>
            <a href="{{ route('admin.kategori') }}" class="block py-3 px-6 text-gray-700 hover:bg-pink-100">Kategori</a>
            <a href="#" class="block py-3 px-6 text-gray-700 hover:bg-pink-100">Pesanan</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col w-full">
        <!-- Topbar -->
        <header class="bg-white flex justify-between items-center px-6 py-4 shadow-md">
            <!-- Dashboard Info (Admin Name & Profile) -->
            <div class="flex items-center">
                <h1 class="text-xl font-bold text-pink-600">Produk</h1>
            </div>
            
            <!-- Admin Foto, Nama, dan Lihat Profil -->
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/pas foto.jpg') }}" alt="Admin" class="w-16 h-16 rounded-full border-2 border-pink-400 object-cover">
                <div class="flex flex-col">
                    <span class="text-sm font-medium text-gray-700">Admin {{ session('namapengguna') }}</span>
                    <a href="/admin/profil" class="text-sm text-pink-600 hover:underline">Lihat Profil</a>
                </div>
            </div>
        </header>

        <!-- Flash Message -->
        @if(session('success'))
            <div class="bg-pink-600 text-white p-3 mt-4 rounded-lg shadow-md w-80 mx-auto">
                <strong>Berhasil!</strong> {{ session('success') }}
            </div>
        @endif

        <!-- Produk Grid -->
        <section class="p-6 mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($produks as $item)
                <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg">
                    <img src="{{ asset('images/' . $item->nama_produk . '.png') }}" alt="{{ $item->nama_produk }}" class="w-full h-48 object-cover rounded-md cursor-pointer" onclick="window.location='{{ route('admin.showProduk', $item->id) }}'">
                    <h2 class="text-pink-600 font-semibold mt-4">{{ $item->nama_produk }}</h2>
                    <p class="text-gray-500">{{ $item->kategori }}</p>
                    <p class="text-gray-600 mt-2">Rp {{ number_format(floatval($item->harga), 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-400 mt-2">Stok: {{ $item->jumlah_stok }}</p>
                </div>
            @endforeach
        </section>

        <!-- Tombol Tambah Produk -->
        <div class="fixed bottom-10 right-10">
            <a href="{{ route('admin.produk_create') }}" class="bg-pink-600 text-white rounded-full p-4 shadow-lg hover:bg-pink-700 transition duration-300">
                <span class="text-2xl font-semibold">+</span>
            </a>
        </div>
    </div>

</body>
</html>
