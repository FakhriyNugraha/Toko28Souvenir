<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-pink-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md h-screen">
        <div class="p-6 text-pink-600 text-2xl font-bold border-b">Toko28Souvenir</div>
        <nav class="mt-6">
            <a href="#" class="block py-3 px-6 text-pink-700 hover:bg-pink-100">Beranda</a>
            <a href="/admin/produk" class="block py-3 px-6 text-pink-700 hover:bg-pink-100">Produk</a>
            <a href="#" class="block py-3 px-6 text-gray-700 hover:bg-pink-100">Kategori</a>
            <a href="#" class="block py-3 px-6 text-gray-700 hover:bg-pink-100">Pesanan</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col w-full">
        <!-- Topbar -->
        <header class="bg-white flex items-center px-6 py-4 shadow-md space-x-6 rounded-lg">
            <img src="{{ asset('images/pas foto.jpg') }}" alt="Admin" class="w-16 h-16 rounded-full border-2 border-pink-400 object-cover">
            <div class="flex flex-col">
                <h1 class="text-xl font-bold text-pink-600">Edit Profil Admin</h1>
            </div>
        </header>

        <!-- Form Edit Profil Admin -->
        <section class="mt-8 bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('admin.updateprofil') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="namapengguna" class="block text-gray-700 font-semibold">Nama Pengguna</label>
                    <input type="text" id="namapengguna" name="namapengguna" value="{{ session('namapengguna') }}" class="w-full p-3 mt-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500" required>
                </div>

                <div class="mb-6">
                    <label for="katasandi" class="block text-gray-700 font-semibold">Kata Sandi</label>
                    <input type="password" id="katasandi" name="katasandi" class="w-full p-3 mt-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500" placeholder="Kosongkan jika tidak ingin mengubah kata sandi">
                </div>

                <div class="mb-6">
                    <label for="katasandi_confirmation" class="block text-gray-700 font-semibold">Konfirmasi Kata Sandi</label>
                    <input type="password" id="katasandi_confirmation" name="katasandi_confirmation" class="w-full p-3 mt-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-pink-600 text-white px-6 py-3 rounded-md hover:bg-pink-700 transition duration-200">Perbarui Profil</button>
                </div>
            </form>
        </section>
    </div>

</body>
</html>
