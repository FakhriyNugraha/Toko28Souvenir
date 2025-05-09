<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Pembeli - Toko28Souvenir</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-pink-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow-md p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('pembeli.beranda') }}" class="text-2xl font-bold text-pink-600">Toko28Souvenir</a>

            <!-- Menampilkan Foto Pengguna atau Login & Daftar -->
            <div class="flex items-center space-x-4">
                @if(session('pembeli_id') && $pembeli)
                    <!-- Jika pembeli sudah login, tampilkan foto profil dan nama pengguna -->
                    <img src="{{ asset('/' . $pembeli->foto) }}" alt="Foto Profil" class="w-10 h-10 rounded-full object-cover">
                    <span class="text-pink-600">{{ $pembeli->namapengguna }}</span>
                @else
                    <a href="{{ route('pembeli.login') }}" class="text-pink-600 hover:text-pink-700">Login</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto my-8">
        <h2 class="text-3xl font-semibold text-center text-pink-600 mb-8">Edit Profil Pembeli</h2>

        <!-- Form Edit Profil -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('pembeli.updateprofil') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Menggunakan PUT untuk update -->

                <!-- Foto Profil -->
                <div class="flex items-center space-x-4 mb-6">
                    <img src="{{ asset('' . $pembeli->foto) }}" alt="Foto Profil" class="w-24 h-24 rounded-full object-cover">
                    <div>
                        <label for="foto" class="block text-sm font-semibold text-pink-600">Ubah Foto Profil</label>
                        <input type="file" id="foto" name="foto" class="w-full border border-pink-300 rounded-lg">
                    </div>
                </div>

                <!-- Nama Pengguna -->
                <div class="mb-6">
                    <label for="namapengguna" class="block text-sm font-semibold text-pink-600">Nama Pengguna</label>
                    <input type="text" id="namapengguna" name="namapengguna" value="{{ $pembeli->namapengguna }}" required
                        class="w-full p-2 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>

                <!-- Kata Sandi -->
                <div class="mb-6">
                    <label for="katasandi" class="block text-sm font-semibold text-pink-600">Kata Sandi Baru</label>
                    <input type="password" id="katasandi" name="katasandi" placeholder="Kosongkan jika tidak ingin mengubah kata sandi"
                        class="w-full p-2 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>

                <div class="mb-6">
                    <label for="katasandi_confirmation" class="block text-sm font-semibold text-pink-600">Konfirmasi Kata Sandi</label>
                    <input type="password" id="katasandi_confirmation" name="katasandi_confirmation" placeholder="Konfirmasi kata sandi"
                        class="w-full p-2 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="submit" class="bg-pink-600 text-white px-6 py-3 rounded-md hover:bg-pink-700 transition duration-200">
                        Perbarui Profil
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
