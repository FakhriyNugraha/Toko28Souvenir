<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama Pembeli - Toko28Souvenir</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-pink-100 min-h-screen">

   <!-- Navbar -->
   <nav class="bg-white shadow-md p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="#" class="text-2xl font-bold text-pink-600">Toko28Souvenir</a>

        <!-- Fitur Pencarian -->
        <form action="{{ url('/pembeli/beranda') }}" method="GET" class="flex items-center space-x-2">
            <input type="text" name="search" class="p-2 border border-pink-300 rounded-lg" placeholder="Cari produk..." value="{{ request('search') }}">
            <button type="submit" class="ml-2 bg-pink-600 text-white p-2 rounded-lg">Cari</button>
        </form>

        <!-- Menampilkan Foto Pengguna atau Login & Daftar -->
        <div class="flex items-center space-x-4">
            @if(session('pembeli_id') && $pembeli)
                <!-- Jika pembeli sudah login, tampilkan foto profil dan buat foto atau nama pengguna menjadi link ke halaman profil -->
                <a href="{{ route('pembeli.profil') }}">
                    <img src="{{ asset('' . $pembeli->foto) }}" alt="Foto Profil" class="w-10 h-10 rounded-full object-cover">
                </a>
                <a href="{{ route('pembeli.profil') }}" class="text-pink-600">{{ $pembeli->namapengguna }}</a>
            @else
                <!-- Jika belum login, tampilkan link login dan daftar -->
                <a href="{{ route('pembeli.login') }}" class="text-pink-600 hover:text-pink-700">Login</a> | 
                <a href="{{ route('pembeli.daftar') }}" class="text-pink-600 hover:text-pink-700">Daftar</a>
            @endif
        </div>
    </div>
</nav>


<!-- Main Content -->
<main class="container mx-auto my-8">
    <h2 class="text-3xl font-semibold text-center text-pink-600 mb-8">Produk Terbaru</h2>

    <!-- Menampilkan Pesan jika Tidak Ada Hasil Pencarian -->
    @if($produks->isEmpty())
        <p class="text-center text-pink-600 font-semibold">Pencarian tidak tersedia</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Loop untuk menampilkan semua produk -->
            @foreach($produks as $item)
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-xl transition">
                    <img src="{{ asset('images/' . $item->nama_produk . '.png') }}" alt="{{ $item->nama_produk }}" class="w-full h-48 object-cover rounded-md">
                    <div class="mt-4">
                        <p class="text-xl font-semibold text-pink-600">{{ $item->nama_produk }}</p>
                        <p class="text-gray-500">{{ $item->kategori ?? 'Kategori Tidak Tersedia' }}</p>
                        <p class="text-pink-600 mt-2">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</main>

<!-- Footer -->
<footer class="bg-white shadow-md py-4 mt-8">
    <div class="container mx-auto text-center text-gray-700">
        <p>&copy; 2023 Toko28Souvenir. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
