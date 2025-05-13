<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-pink-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md h-screen">
        <div class="p-6 text-pink-600 text-2xl font-bold border-b">Toko28Souvenir</div>
        <nav class="mt-6">
            <a href="{{ route('admin.beranda') }}" class="block py-3 px-6 text-pink-700 bg-pink-50 font-medium">Beranda</a>
            <a href="{{ route('admin.produk') }}" class="block py-3 px-6 text-gray-700 hover:bg-pink-100">Produk</a>
            <a href="{{ route('admin.kategori') }}" class="block py-3 px-6 text-gray-700 hover:bg-pink-100">Kategori</a>
            <a href="{{ route('admin.pesanan') }}" class="block py-3 px-6 text-gray-700 hover:bg-pink-100">Pesanan</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col w-full">
        <!-- Topbar -->
        <header class="bg-white flex justify-between items-center px-6 py-4 shadow-md">
            <h1 class="text-xl font-bold text-pink-600">Dashboard Admin</h1>
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/pas foto.jpg') }}" alt="Admin" class="w-12 h-12 rounded-full border-2 border-pink-400 object-cover">
                <div class="flex flex-col">
                    <span class="text-sm font-medium text-gray-700">Admin {{ session('namapengguna') }}</span>
                    <a href="/admin/profil" class="text-sm text-pink-600 hover:underline">Lihat Profil</a>
                </div>
            </div>
        </header>

        <!-- Dashboard Cards -->
        <section class="p-6 bg-pink-50 grid grid-cols-1 sm:grid-cols-3 gap-6">
            <!-- Card Produk -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-gray-500 text-sm font-medium">Jumlah Produk</h2>
                <p class="text-2xl font-bold text-pink-600 mt-2">{{ $jumlah_produk }}</p>
                <p class="text-sm text-gray-400">
                    <span class="{{ $produk_stok_rendah > 0 ? 'text-red-500' : 'text-green-500' }}">
                        {{ $produk_stok_rendah }} Produk Stok Rendah
                    </span>
                </p>
            </div>
            
            <!-- Card Pesanan -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-gray-500 text-sm font-medium">Total Pesanan</h2>
                <p class="text-2xl font-bold text-pink-600 mt-2">{{ $total_pesanan }}</p>
                <p class="text-sm text-gray-400">{{ $pesanan_proses }} Menunggu Diproses</p>
            </div>
            
            <!-- Card Pembayaran -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-gray-500 text-sm font-medium">Total Pendapatan</h2>
                <p class="text-2xl font-bold text-pink-600 mt-2">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-400">
                    @if($transaksi_terakhir)
                        Transaksi Terakhir: {{ $transaksi_terakhir->created_at->diffForHumans() }}
                    @else
                        Belum ada transaksi
                    @endif
                </p>
            </div>
        </section>

        <!-- Aktivitas Terkini -->
        <section class="p-6 mt-6">
            <h2 class="text-lg font-semibold text-pink-600 mb-4">Aktivitas Transaksi Terkini</h2>
            <div class="bg-white rounded-lg shadow overflow-hidden">
                @if($aktivitas->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-pink-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pembeli</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($aktivitas as $transaksi)
                            <tr>
                                <td class="px-6 py-4">{{ $transaksi->id }}</td>
                                <td class="px-6 py-4">{{ $transaksi->namapengguna }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        @if($transaksi->status == 'selesai') bg-green-100 text-green-800
                                        @elseif($transaksi->status == 'dibatalkan') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ ucfirst($transaksi->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $transaksi->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-6 text-center text-gray-500">
                        Belum ada aktivitas transaksi
                    </div>
                @endif
            </div>
        </section>
    </div>
</body>
</html>