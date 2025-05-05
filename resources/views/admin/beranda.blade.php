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
            <a href="#" class="block py-3 px-6 text-pink-700 hover:bg-pink-100">Beranda</a>
            <a href="#" class="block py-3 px-6 text-gray-700 hover:bg-pink-100">Produk</a>
            <a href="#" class="block py-3 px-6 text-gray-700 hover:bg-pink-100">Pesanan</a>
            <a href="#" class="block py-3 px-6 text-gray-700 hover:bg-pink-100">Pembayaran</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col w-full">
        <!-- Topbar and Dashboard Info (Profil, Foto, dan Cards) -->
        <header class="bg-white flex items-center px-6 py-4 shadow-md space-x-6">
            <!-- Profil Admin dan Foto -->
            <img src="{{ asset('images/pas foto.jpg') }}" alt="Admin"
                 class="w-16 h-16 rounded-full border-2 border-pink-400 object-cover">
            <div class="flex flex-col">
                <h1 class="text-xl font-bold text-pink-600">Dashboard Admin</h1>
                <span class="text-sm font-medium text-gray-700">Admin {{ session('namapengguna') }}</span>
                <a href="#" class="text-sm text-pink-600 hover:underline">Lihat Profil</a>
            </div>
        </header>

        <!-- Dashboard Cards (Jumlah Produk, Total Pesanan, Pembayaran) -->
        <section class="p-6 bg-pink-50 grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-gray-500 text-sm font-medium">Jumlah Produk</h2>
                <p class="text-2xl font-bold text-pink-600 mt-2">120</p>
                <p class="text-sm text-gray-400">10 Produk Baru</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-gray-500 text-sm font-medium">Total Pesanan</h2>
                <p class="text-2xl font-bold text-pink-600 mt-2">85</p>
                <p class="text-sm text-gray-400">5 Menunggu</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-gray-500 text-sm font-medium">Pembayaran</h2>
                <p class="text-2xl font-bold text-pink-600 mt-2">Rp 12.500.000</p>
                <p class="text-sm text-gray-400">Terakhir 2 jam lalu</p>
            </div>
        </section>

        <!-- Aktifitas atau Konten Tambahan -->
        <section class="p-6 mt-6">
            <h2 class="text-lg font-semibold text-pink-600 mb-4">Aktivitas Terkini</h2>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-600">Belum ada aktivitas terbaru.</p>
            </div>
        </section>
    </div>

</body>
</html>
