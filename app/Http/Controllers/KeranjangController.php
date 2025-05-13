<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\kategori;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class KeranjangController extends Controller
{
    public function index()
    {
        $pembeli_id = session('pembeli_id');
        $items = Keranjang::with('produk')
            ->where('pembeli_id', $pembeli_id)
            ->get();

        return view('pembeli.keranjang', compact('items'));
    }

    public function tambah(Request $request, $produk_id)
    {
        $request->validate(['jumlah' => 'required|integer|min:1']);
        $pembeli_id = session('pembeli_id');

        $existing = Keranjang::where('pembeli_id', $pembeli_id)
            ->where('produk_id', $produk_id)
            ->first();

        if ($existing) {
            $existing->jumlah += $request->jumlah;
            $existing->save();
        } else {
            Keranjang::create([
                'pembeli_id' => $pembeli_id,
                'produk_id' => $produk_id,
                'jumlah' => $request->jumlah,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function hapus($id)
    {
        $item = Keranjang::findOrFail($id);

        if ($item->pembeli_id == session('pembeli_id')) {
            $item->delete();
        }

        return redirect()->route('pembeli.keranjang.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        Log::info('Checkout started', ['request' => $request->all()]);
        
        $pembeli_id = session('pembeli_id');
        $namapengguna = session('nama_pembeli');
    
        Log::info('Session data', [
            'pembeli_id' => $pembeli_id,
            'nama_pembeli' => $namapengguna
        ]);
    
        if (!$pembeli_id || !$namapengguna) {
            Log::error('Session data missing');
            return redirect()->route('pembeli.keranjang.index')->with('error', 'Sesi tidak valid. Silakan login kembali.');
        }
    
        $request->validate([
            'selected_items' => 'required|array|min:1',
            'selected_items.*' => 'exists:keranjangs,id,pembeli_id,' . $pembeli_id,
            'alamat' => 'required|string|min:5',
        ]);
        
        $selected_items = Keranjang::with('produk')
            ->whereIn('id', $request->selected_items)
            ->where('pembeli_id', $pembeli_id)
            ->get();
        
        Log::info('Selected items', ['items' => $selected_items->toArray()]);
        
        // Validasi stok
        foreach ($selected_items as $item) {
            if ($item->jumlah > $item->produk->jumlah_stok) {
                Log::error('Insufficient stock', [
                    'product' => $item->produk->nama_produk,
                    'requested' => $item->jumlah,
                    'available' => $item->produk->jumlah_stok
                ]);
                return redirect()->route('pembeli.keranjang.index')->with('error', "Stok tidak cukup untuk produk: {$item->produk->nama_produk}");
            }
        }
        
        DB::beginTransaction();
        
        try {
            $total_harga = 0;
        
            foreach ($selected_items as $item) {
                $total_harga += $item->produk->harga * $item->jumlah;
            }
        
            Log::info('Creating transaction', ['total' => $total_harga]);
        
            $transaksi = Transaksi::create([
                'namapengguna' => $namapengguna,
                'alamat' => $request->alamat, // tambahkan alamat dari form
                'total_harga' => $total_harga,
            ]);
        
            Log::info('Transaction created', ['transaction' => $transaksi->toArray()]);
        
            foreach ($selected_items as $item) {
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $item->produk_id,
                    'jumlah' => $item->jumlah,
                    'harga_satuan' => $item->produk->harga,
                ]);
        
                $produk = $item->produk;
                $produk->jumlah_stok -= $item->jumlah;
                $produk->save();
        
                $item->delete();
            }
        
            DB::commit();
            Log::info('Checkout successful');
        
            return redirect()->route('pembeli.keranjang.index')->with('success', 'Checkout berhasil dan transaksi disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('pembeli.keranjang.index')->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }
}
