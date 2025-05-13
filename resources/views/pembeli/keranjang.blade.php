<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-pink-100 min-h-screen">

<nav class="bg-white shadow p-4">
    <div class="container mx-auto flex justify-between">
        <a href="{{ url('/pembeli/beranda') }}" class="text-xl font-bold text-pink-600">Toko28Souvenir</a>
        <a href="{{ route('pembeli.keranjang.index') }}" class="text-pink-600">Keranjang</a>
    </div>
</nav>

<div class="container mx-auto p-4">
    @if(session('success'))
        <div class="bg-green-100 text-green-700 border border-green-400 rounded p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 border border-red-400 rounded p-4 mb-4">
            {{ session('error') }}
        </div>
    @endif

    <h2 class="text-2xl font-bold text-pink-700 mb-4">Keranjang Belanja</h2>

    @if($items->isEmpty())
        <p class="text-pink-700 font-semibold">Keranjang Anda kosong.</p>
    @else
        <form method="POST" action="{{ route('pembeli.keranjang.checkout') }}" id="checkoutForm">
            @csrf
            <div class="overflow-x-auto bg-white rounded shadow p-4">
                <table class="w-full text-left">
                    <thead class="bg-pink-200">
                        <tr>
                            <th class="p-2">Pilih</th>
                            <th class="p-2">Produk</th>
                            <th class="p-2">Harga</th>
                            <th class="p-2">Jumlah</th>
                            <th class="p-2">Subtotal</th>
                            <th class="p-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($items as $item)
                            @php
                                $subtotal = $item->produk->harga * $item->jumlah;
                                $total += $subtotal;
                            @endphp
                            <tr class="border-b">
                                <td class="p-2 text-center">
                                    <input type="checkbox" name="selected_items[]" value="{{ $item->id }}">
                                </td>
                                <td class="p-2 flex items-center gap-2">
                                    <img src="{{ asset('images/' . $item->produk->nama_produk . '.png') }}" class="w-12 h-12 object-cover rounded" alt="{{ $item->produk->nama_produk }}">
                                    {{ $item->produk->nama_produk }}
                                </td>
                                <td class="p-2">Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                                <td class="p-2">{{ $item->jumlah }}</td>
                                <td class="p-2">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                <td class="p-2 text-center">
                                    <button type="button" 
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded delete-btn" 
                                            data-id="{{ $item->id }}">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="font-bold bg-pink-100">
                            <td colspan="4" class="p-2 text-right">Total:</td>
                            <td class="p-2">Rp {{ number_format($total, 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Tambahkan ini setelah tabel dan sebelum tombol submit -->
                <div class="mt-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Pengiriman:</label>
                    <textarea name="alamat" id="alamat" class="border p-2 w-full mt-1 rounded" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4 text-right">
                    <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-2 rounded">Checkout yang Dipilih</button>
                </div>
            </div>
        </form>
    @endif
</div>

<script>
    // Handle delete button
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            if(confirm('Yakin ingin menghapus item ini?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/pembeli/keranjang/${this.dataset.id}`;
                
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = document.querySelector('meta[name="csrf-token"]').content;
                
                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';
                
                form.appendChild(csrf);
                form.appendChild(method);
                document.body.appendChild(form);
                form.submit();
            }
        });
    });

    // Handle checkout form validation
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        const checked = document.querySelectorAll("input[name='selected_items[]']:checked");
        if (checked.length === 0) {
            e.preventDefault();
            alert('Pilih minimal satu produk untuk checkout.');
        }
    });
</script>

</body>
</html>