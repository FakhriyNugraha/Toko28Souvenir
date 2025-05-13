<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Admin</title>
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
        <header class="bg-white flex items-center px-6 py-4 shadow-md space-x-6 rounded-lg">
            <div class="flex flex-col">
                <h1 class="text-xl font-bold text-pink-600">Profil Admin</h1>
            </div>
        </header>

        <!-- Profil Admin -->
        <section class="mt-8 bg-white rounded-lg shadow-md p-6">
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Profil Admin -->
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Foto Profil dengan Bingkai Rounded dan Lebih Besar -->
                    <div class="flex justify-center items-center">
                        <img src="{{ asset('images/pas foto.jpg') }}" alt="Admin" class="w-48 h-48 rounded-lg border-4 border-pink-400 object-cover">
                    </div>
                    <!-- Nama Pengguna & Kata Sandi -->
                    <div class="space-y-6">
                        <div>
                            <label for="namapengguna" class="block text-gray-700 font-semibold">Nama Pengguna</label>
                            <input type="text" id="namapengguna" name="namapengguna" value="{{ $admin->namapengguna }}" class="w-full p-3 mt-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500" disabled>
                        </div>

                        <div class="relative">
                            <label for="katasandi" class="block text-gray-700 font-semibold">Kata Sandi</label>
                            <input type="password" id="katasandi" name="katasandi" class="w-full p-3 mt-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500" value="*****" disabled>
                            <button type="button" onclick="togglePasswordVisibility()" class="absolute right-3 top-3 text-pink-600">
                                <i id="toggle-icon" class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tombol Edit Profil -->
                <div class="mt-6 flex justify-end space-x-4">
                    <a href="{{ route('admin.editprofil') }}" class="bg-pink-600 text-white px-6 py-3 rounded-md hover:bg-pink-700 transition duration-200">Edit Profil</a>
                    
                    <!-- Tombol Logout yang memicu Modal Konfirmasi -->
                    <button type="button" onclick="showLogoutModal()" class="bg-red-600 text-white px-6 py-3 rounded-md hover:bg-red-700 transition duration-200">Logout</button>
                </div>
            </form>
        </section>

        <!-- Modal Konfirmasi Logout -->
        <div id="logout-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg w-96">
                <h2 class="text-xl font-bold text-red-600">Konfirmasi Logout</h2>
                <p class="mt-4">Apakah Anda yakin ingin keluar dari akun ini?</p>
                <div class="mt-6 flex justify-between">
                    <button onclick="hideLogoutModal()" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-md">Batal</button>
                    <form action="{{ url('/admin/keluar') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-md">Ya, Logout</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Fungsi untuk menampilkan atau menyembunyikan kata sandi
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('katasandi');
            const passwordType = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = passwordType;
            const icon = document.getElementById('toggle-icon');
            if (passwordField.type === 'password') {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }

        // Menampilkan Modal Konfirmasi Logout
        function showLogoutModal() {
            document.getElementById('logout-modal').classList.remove('hidden');
        }

        // Menyembunyikan Modal Konfirmasi Logout
        function hideLogoutModal() {
            document.getElementById('logout-modal').classList.add('hidden');
        }
    </script>

</body>
</html>
