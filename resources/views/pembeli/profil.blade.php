<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pembeli - Toko28Souvenir</title>
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
                    <img src="{{ asset('' . $pembeli->foto) }}" alt="Foto Profil" class="w-10 h-10 rounded-full object-cover">
                    <span class="text-pink-600">{{ $pembeli->namapengguna }}</span>
                @else
                    <a href="{{ route('pembeli.login') }}" class="text-pink-600 hover:text-pink-700">Login</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto my-8">
        <h2 class="text-3xl font-semibold text-center text-pink-600 mb-8">Profil Pembeli</h2>

        <!-- Menampilkan Data Profil -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('' . $pembeli->foto) }}" alt="Foto Profil" class="w-24 h-24 rounded-full object-cover">
                <div>
                    <h3 class="text-xl font-semibold text-pink-600">{{ $pembeli->namapengguna }}</h3>
                    <p class="text-gray-600">{{ $pembeli->email }}</p>
                </div>
            </div>
        </div>

        <!-- Tombol Edit Profil -->
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('pembeli.editprofil') }}" class="bg-pink-600 text-white px-6 py-3 rounded-md hover:bg-pink-700 transition duration-200">Edit Profil</a>

            <!-- Tombol Logout -->
            <form action="{{ url('/pembeli/keluar') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-md hover:bg-red-700 transition duration-200">Logout</button>
            </form>
        </div>
    </main>

</body>
</html>
