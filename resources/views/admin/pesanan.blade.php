<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-pink-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md h-screen">
        <div class="p-6 text-pink-600 text-2xl font-bold border-b">Toko28Souvenir</div>
        <nav class="mt-6">
            <a href="{{ route('admin.beranda') }}" class="block py-3 px-6 text-pink-700 hover:bg-pink-100">Beranda</a>
            <a href="{{ route('admin.produk') }}" class="block py-3 px-6 text-pink-700 hover:bg-pink-100">Produk</a>
            <a href="{{ route('admin.kategori') }}" class="block py-3 px-6 text-pink-700 hover:bg-pink-100">Kategori</a>
            <a href="{{ route('admin.pesanan') }}" class="block py-3 px-6 text-gray-700 hover:bg-pink-100">Pesanan</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col w-full">
        <!-- Topbar -->
        <header class="bg-white flex justify-between items-center px-6 py-4 shadow-md">
            <h1 class="text-xl font-bold text-pink-600">Daftar Pesanan</h1>
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/pas foto.jpg') }}" alt="Admin" class="w-12 h-12 rounded-full border-2 border-pink-400 object-cover">
                <div class="flex flex-col">
                    <span class="text-sm font-medium text-gray-700">Admin {{ session('namapengguna') }}</span>
                    <a href="/admin/profil" class="text-sm text-pink-600 hover:underline">Lihat Profil</a>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="p-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-pink-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pembeli</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($transaksis as $transaksi)
                        <tr>
                            <td class="px-6 py-4">{{ $transaksi->id }}</td>
                            <td class="px-6 py-4">{{ $transaksi->namapengguna }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ $transaksi->created_at->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full
                                    @if($transaksi->status == 'selesai') bg-green-100 text-green-800
                                    @elseif($transaksi->status == 'dibatalkan') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ ucfirst($transaksi->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.pesanan.show', $transaksi->id) }}"
                                   class="text-blue-600 hover:text-blue-900">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-6 py-4">
                    {{ $transaksis->links() }}
                </div>
            </div>
        </main>
    </div>

</body>
</html>
