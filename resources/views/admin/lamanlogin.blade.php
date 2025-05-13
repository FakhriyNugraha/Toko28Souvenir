<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko28Souvenir</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-pink-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-4xl bg-white shadow-2xl rounded-2xl overflow-hidden flex flex-col md:flex-row">
        <!-- Gambar -->
        <div class="md:w-1/2 hidden md:block">
            <img src="{{ asset('images/logo28souvenir.jpg') }}"
                 alt="Souvenir Illustration"
                 class="h-full w-full object-cover">
        </div>
        <!-- Form Login -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <h2 class="text-2xl font-bold text-pink-700 mb-6 text-center">Masuk ke Admin Toko28Souvenir</h2>
                <form action="/admin/masuk" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="namapengguna" class="block mb-1 text-sm font-semibold text-pink-600">Nama Pengguna</label>
                        <input type="text" id="namapengguna" name="namapengguna" required
                            class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                    <div>
                        <label for="katasandi" class="block mb-1 text-sm font-semibold text-pink-600">Kata Sandi</label>
                        <input type="password" id="katasandi" name="katasandi" required
                            class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                    @if ($errors->has('invalid'))
                        <p class="text-red-500 text-sm text-center">{{ $errors->first('invalid') }}</p>
                    @endif
                    <button type="submit"
                        class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
