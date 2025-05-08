<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kategori</title>
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
            <a href="#" class="block py-3 px-6 text-gray-700 hover:bg-pink-100">Pesanan</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col w-full">
        <!-- Topbar -->
        <header class="bg-white flex justify-between items-center px-6 py-4 shadow-md">
            <h1 class="text-xl font-bold text-pink-600">Kategori</h1>
           

            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/pas foto.jpg') }}" alt="Admin" class="w-16 h-16 rounded-full border-2 border-pink-400 object-cover">
                <div class="flex flex-col">
                    <span class="text-sm font-medium text-gray-700">Admin {{ session('namapengguna') }}</span>
                    <a href="/admin/profil" class="text-sm text-pink-600 hover:underline">Lihat Profil</a>
                </div>
            </div>
        </header>

        <!-- Kategori Grid -->
        <section class="p-6 mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($kategoris as $kategori)
                <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg">
                    <h2 class="text-pink-600 font-semibold text-lg">{{ $kategori->nama }}</h2>
                    <p class="text-gray-500 text-sm mt-2">Jumlah Produk: {{ $kategori->produk->count() }}</p>
                    <div class="flex justify-between mt-4">
                        <a href="{{ route('admin.edit_kategori', $kategori->id) }}" class="text-blue-600">Edit</a>

                        <!-- Hapus Kategori Button -->
                        <button onclick="showDeleteConfirmModal({{ $kategori->id }})" class="text-red-600">Hapus</button>

                        <!-- Delete Form (Hidden initially) -->
                        <form id="delete-form-{{ $kategori->id }}" action="{{ route('admin.delete_kategori', $kategori->id) }}" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            @endforeach
        </section>

        <!-- Modal Konfirmasi Hapus Kategori -->
        <div id="delete-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg w-96">
                <h2 class="text-xl font-bold text-red-600">Konfirmasi Hapus</h2>
                <p class="mt-4">Apakah Anda yakin ingin menghapus kategori ini?</p>
                <div class="mt-6 flex justify-between">
                    <button onclick="hideDeleteConfirmModal()" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-md">Batal</button>
                    <button id="confirm-delete-btn" class="bg-red-600 text-white px-6 py-3 rounded-md">Ya, Hapus</button>
                </div>
            </div>
        </div>

        <!-- Button untuk Tambah Kategori -->
        <div class="fixed bottom-10 right-10">
            <a href="{{ route('admin.create_kategori') }}" class="bg-pink-600 text-white rounded-full p-4 shadow-lg hover:bg-pink-700 transition duration-300">
                <span class="text-2xl font-semibold">+</span>
            </a>
        </div>
    </div>

    <script>
        function showDeleteConfirmModal(kategoriId) {
            // Show the modal and set the action for delete form
            document.getElementById('delete-modal').classList.remove('hidden');
            document.getElementById('confirm-delete-btn').onclick = function() {
                document.getElementById('delete-form-' + kategoriId).submit();
            };
        }

        function hideDeleteConfirmModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }
    </script>
</body>
</html>
