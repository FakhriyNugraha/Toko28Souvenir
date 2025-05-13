<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori</title>
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
            <h1 class="text-xl font-bold text-pink-600">Tambah Kategori</h1>

            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/pas foto.jpg') }}" alt="Admin" class="w-16 h-16 rounded-full border-2 border-pink-400 object-cover">
                <div class="flex flex-col">
                    <span class="text-sm font-medium text-gray-700">Admin {{ session('namapengguna') }}</span>
                    <a href="/admin/profil" class="text-sm text-pink-600 hover:underline">Lihat Profil</a>
                </div>
        </header>

        <!-- Form Create Kategori -->
        <section class="p-6 mt-6 bg-white rounded-lg shadow-md">
            <form action="{{ route('admin.store_kategori') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="nama" class="block text-gray-700 font-semibold">Nama Kategori</label>
                    <input type="text" id="nama" name="nama" class="w-full p-4 mt-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500" required>
                </div>
                <button type="submit" class="bg-pink-600 text-white px-6 py-3 rounded-md hover:bg-pink-700 transition duration-200">Tambah Kategori</button>
            </form>
        </section>
    </div>

</body>
</html>
