<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('details.produk')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.pesanan', compact('transaksis'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('details.produk')->findOrFail($id);
        return view('admin.detail_pesanan', compact('transaksi'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:proses,dikirim,selesai,dibatalkan'
        ]);
    
        $transaksi = Transaksi::findOrFail($id);
    
        // Jika status selesai, hanya update status tanpa menghapus pesanan
        if ($request->status === 'selesai') {
            $transaksi->status = 'selesai';
            $transaksi->save();

            return redirect()->route('admin.pesanan')->with('success', 'Pesanan telah diselesaikan.');
        }
    
        // Update status selain selesai
        $transaksi->status = $request->status;
        $transaksi->save();
    
        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function hapusPesanan($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->details()->delete(); // Hapus detail produk terkait
        $transaksi->delete(); // Hapus transaksi utama

        return redirect()->route('admin.pesanan')->with('success', 'Pesanan berhasil dihapus.');
    }
}
