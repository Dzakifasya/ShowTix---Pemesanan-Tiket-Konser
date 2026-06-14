<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $transaksiId = session('transaksi_id');

        if (!$transaksiId) {
            return redirect()->route('cart.index')->with('error', 'Sesi Anda telah habis');
        }

        $transaksi = Transaksi::find($transaksiId);

        if (!$transaksi || $transaksi->pembeli->user_id !== auth()->id()) {
            return redirect()->route('cart.index')->with('error', 'Transaksi tidak ditemukan');
        }

        return view('payment.index', compact('transaksi'));
    }

    public function verify(Request $request)
    {
        $validated = $request->validate([
            'transaksi_id' => 'required|exists:transaksis,id',
            'waktu_transaksi' => 'required|date_format:Y-m-d\TH:i',
            'nomor_referensi' => 'required|string|max:100',
        ]);

        $transaksi = Transaksi::find($validated['transaksi_id']);

        if ($transaksi->pembeli->user_id !== auth()->id()) {
            return back()->with('error', 'Anda tidak berhak mengakses transaksi ini');
        }

        // Update transaction status
        $transaksi->update([
            'status_transaksi' => 'verifikasi',
            'waktu_transaksi' => $validated['waktu_transaksi'],
            'nomor_referensi' => $validated['nomor_referensi'],
        ]);

        return redirect()->route('payment.success', $transaksi->id)
                       ->with('success', 'Pembayaran berhasil diverifikasi, silakan tunggu konfirmasi dari admin');
    }

    public function success($transaksiId)
    {
        $transaksi = Transaksi::with(['pemesanan.tiket', 'pembeli'])
                             ->find($transaksiId);

        if (!$transaksi || $transaksi->pembeli->user_id !== auth()->id()) {
            return redirect()->route('home')->with('error', 'Transaksi tidak ditemukan');
        }

        return view('payment.success', compact('transaksi'));
    }

    public function webhook(Request $request)
    {
        // This is for payment gateway webhooks (if using Midtrans, Doku, etc.)
        // For now, just acknowledge the request
        return response()->json(['status' => 'ok']);
    }
}
