<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pesanan - Admin</title>
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
            <h1 class="text-xl font-bold text-pink-600">Detail Pesanan #{{ $transaksi->id }}</h1>
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
            <div class="mb-4">
                <a href="{{ route('admin.pesanan') }}" class="text-blue-600 hover:underline">← Kembali ke daftar pesanan</a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p><strong>Nama Pembeli:</strong> {{ $transaksi->namapengguna }}</p>
                    <p><strong>Alamat Pengiriman:</strong> {{ $transaksi->alamat }}</p>
                    <p><strong>Tanggal Pesan:</strong> {{ $transaksi->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <p><strong>Total Harga:</strong> Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                    <p><strong>Status:</strong> 
                        <span class="px-2 py-1 text-xs rounded-full 
                            @if($transaksi->status == 'selesai') bg-green-100 text-green-800
                            @elseif($transaksi->status == 'dibatalkan') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            {{ ucfirst($transaksi->status) }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Form Update Status -->
            <form action="{{ route('admin.pesanan.update-status', $transaksi->id) }}" method="POST" class="mt-4" id="update-status-form">
                @csrf
                <div class="flex items-center gap-4">
                    <select name="status" class="border rounded p-2" id="status-select">
                        <option value="proses" {{ $transaksi->status == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="dikirim" {{ $transaksi->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                        <option value="selesai" {{ $transaksi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ $transaksi->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded" id="submit-btn">Update Status</button>
                </div>
            </form>

            <!-- Modal Konfirmasi -->
            <div id="confirmation-modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
                <div class="bg-white rounded-lg p-6 shadow-xl w-96">
                    <h3 class="text-xl font-semibold mb-4">Konfirmasi Penyelesaian Pesanan</h3>
                    <p>Apakah Anda yakin pesanan ini telah selesai? Pesanan akan dihapus setelah status diubah.</p>
                    <div class="mt-4 flex justify-between">
                        <button id="cancel-btn" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</button>
                        <form action="{{ route('admin.pesanan.update-status', $transaksi->id) }}" method="POST" id="confirm-form">
                            @csrf
                            <input type="hidden" name="status" value="selesai">
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Ya, Selesai</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Daftar Produk -->
            <div class="bg-white rounded-lg shadow p-6 mt-6">
                <h2 class="text-xl font-semibold mb-4">Daftar Produk</h2>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-pink-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($transaksi->details as $detail)
                        <tr>
                            <td class="px-6 py-4 flex items-center">
                                <img src="{{ asset('images/' . $detail->produk->nama_produk . '.png') }}" 
                                    class="w-10 h-10 object-cover rounded mr-3" 
                                    alt="{{ $detail->produk->nama_produk }}">

                                {{ $detail->produk->nama_produk }}
                            </td>
                            <td class="px-6 py-4">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ $detail->jumlah }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($detail->harga_satuan * $detail->jumlah, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('submit-btn').addEventListener('click', function() {
            const statusSelect = document.getElementById('status-select');
            const status = statusSelect.value;

            if (status === 'selesai') {
                document.getElementById('confirmation-modal').classList.remove('hidden');
            } else {
                document.getElementById('update-status-form').submit();
            }
        });

        document.getElementById('cancel-btn').addEventListener('click', function() {
            document.getElementById('confirmation-modal').classList.add('hidden');
        });

        document.getElementById('confirm-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Jangan kirim form langsung, tunggu konfirmasi
            document.getElementById('update-status-form').submit(); // Kirim form
        });
    </script>
</body>
</html>
