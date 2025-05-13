<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama Pembeli - Toko28Souvenir</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        // Script agar notifikasi menghilang setelah 3 detik
        setTimeout(() => {
            const notif = document.getElementById("notif");
            if (notif) notif.remove();
        }, 3000);
    </script>
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

            <!-- Link ke Keranjang dan Login/Profile -->
            <div class="flex items-center space-x-4">
                <!-- Tombol Keranjang -->
                <a href="{{ route('pembeli.keranjang.index') }}" class="text-pink-600 hover:text-pink-700 flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13L17 13M7 13h10M9 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z"/>
                    </svg>
                    <span>Keranjang</span>
                </a>

                <!-- Login atau Profil -->
                @if(session('pembeli_id') && $pembeli)
                    <a href="{{ route('pembeli.profil') }}">
                        <img src="{{ asset('' . $pembeli->foto) }}" alt="Foto Profil" class="w-10 h-10 rounded-full object-cover">
                    </a>
                    <a href="{{ route('pembeli.profil') }}" class="text-pink-600">{{ $pembeli->namapengguna }}</a>
                @else
                    <a href="{{ route('pembeli.login') }}" class="text-pink-600 hover:text-pink-700">Login</a> | 
                    <a href="{{ route('pembeli.daftar') }}" class="text-pink-600 hover:text-pink-700">Daftar</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Notifikasi -->
    @if(session('success'))
        <div id="notif" class="fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div id="notif" class="fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-lg shadow-lg z-50">
            {{ session('error') }}
        </div>
    @endif

    <!-- Main Content -->
    <main class="container mx-auto my-8">
        <h2 class="text-3xl font-semibold text-center text-pink-600 mb-8">Produk Terbaru</h2>

        @if($produks->isEmpty())
            <p class="text-center text-pink-600 font-semibold">Pencarian tidak tersedia</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($produks as $item)
                    <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-xl transition">
                        <img src="{{ asset('images/' . $item->nama_produk . '.png') }}" alt="{{ $item->nama_produk }}" class="w-full h-48 object-cover rounded-md">
                        <div class="mt-4">
                            <p class="text-xl font-semibold text-pink-600">{{ $item->nama_produk }}</p>
                            <p class="text-gray-500">{{ $item->kategori ?? 'Kategori Tidak Tersedia' }}</p>
                            <p class="text-pink-600 mt-2">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>

                            <!-- Tombol Tambah ke Keranjang -->
                            <form action="{{ route('pembeli.keranjang.tambah', $item->id) }}" method="POST" class="mt-4">
                                @csrf
                                <input type="number" name="jumlah" value="1" min="1" class="border p-2 rounded-lg w-full" required>
                                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-lg w-full mt-2">
                                    Tambah ke Keranjang
                                </button>
                            </form>

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
