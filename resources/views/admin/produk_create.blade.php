<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
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
    <div class="flex-1 flex flex-col w-full bg-pink-50 p-8">

        <!-- Topbar -->
        <header class="bg-white flex items-center px-6 py-4 shadow-md space-x-6 rounded-lg">
            <img src="{{ asset('images/pas foto.jpg') }}" alt="Admin" class="w-16 h-16 rounded-full border-2 border-pink-400 object-cover">
            <div class="flex flex-col">
                <h1 class="text-xl font-bold text-pink-600">Tambah Produk</h1>
            </div>
        </header>

        <!-- Flash Message for Success -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 mt-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Create Produk -->
        <section class="mt-8 bg-white rounded-lg shadow-md p-6">
            <form id="create-form" action="{{ route('admin.storeProduk') }}" method="POST">
                @csrf

                <!-- Nama Produk -->
                <div class="mb-6">
                    <label for="nama_produk" class="block text-gray-700 font-semibold">Nama Produk</label>
                    <input type="text" id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}" class="w-full p-4 mt-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500" required>
                </div>

                <!-- Jumlah Stok -->
                <div class="mb-6">
                    <label for="jumlah_stok" class="block text-gray-700 font-semibold">Jumlah Stok</label>
                    <input type="number" id="jumlah_stok" name="jumlah_stok" value="{{ old('jumlah_stok') }}" class="w-full p-4 mt-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500" required>
                </div>

                <!-- Harga -->
                <div class="mb-6">
                    <label for="harga" class="block text-gray-700 font-semibold">Harga</label>
                    <input type="number" id="harga" name="harga" value="{{ old('harga') }}" class="w-full p-4 mt-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500" required>
                </div>

                <!-- Kategori -->
                <div class="mb-6">
                    <label for="kategori_id" class="block text-gray-700 font-semibold">Kategori</label>
                    <select id="kategori_id" name="kategori_id" class="w-full p-4 mt-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500" required>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Button to Trigger Modal for Confirmation -->
                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-pink-600 text-white px-6 py-3 rounded-md hover:bg-pink-700 transition duration-200" onclick="showConfirmModal()">Tambah Produk</button>
                </div>
            </form>
        </section>
    </div>

    <!-- Modal Konfirmasi Tambah Produk -->
    <div id="confirm-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg w-96">
            <h2 class="text-xl font-bold text-pink-600">Konfirmasi Tambah Produk</h2>
            <p class="mt-4">Apakah Anda yakin ingin menambahkan produk ini?</p>
            <div class="mt-6 flex justify-between">
                <button onclick="hideConfirmModal()" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-md">Batal</button>
                <button onclick="document.getElementById('create-form').submit()" class="bg-pink-600 text-white px-6 py-3 rounded-md">Ya, Tambah</button>
            </div>
        </div>
    </div>

    <script>
        function showConfirmModal() {
            document.getElementById('confirm-modal').classList.remove('hidden');
        }

        function hideConfirmModal() {
            document.getElementById('confirm-modal').classList.add('hidden');
        }
    </script>
</body>
</html>
