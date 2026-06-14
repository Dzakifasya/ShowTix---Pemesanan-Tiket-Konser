<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Tiket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get user's pembeli info
        $pembeli = $user->pembeli;

        // Get transactions
        $transaksi = Transaksi::where('pembeli_id', $pembeli?->id)
                             ->orderByDesc('created_at')
                             ->paginate(10);

        // Get upcoming concerts
        $upcomingConcerts = collect($transaksi)->map(fn($t) => 
            $t->pemesanan->first()?->kategoriTiket?->konser
        )->filter()->unique('id');

        return view('dashboard.index', compact('user', 'transaksi', 'upcomingConcerts'));
    }

    public function profile()
    {
        $user = auth()->user();
        $pembeli = $user->pembeli;

        return view('dashboard.profile', compact('user', 'pembeli'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
        ]);

        auth()->user()->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (!auth()->user()->pembeli) {
            auth()->user()->pembeli()->create([
                'nama_lengkap' => $validated['name'],
                'no_hp' => $validated['no_hp'],
                'alamat' => $validated['alamat'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
            ]);
        } else {
            auth()->user()->pembeli->update([
                'nama_lengkap' => $validated['name'],
                'no_hp' => $validated['no_hp'],
                'alamat' => $validated['alamat'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui');
    }

    public function history()
    {
        $pembeli = auth()->user()->pembeli;
        
        $transaksi = Transaksi::where('pembeli_id', $pembeli?->id)
                             ->orderByDesc('created_at')
                             ->paginate(10);

        return view('dashboard.history', compact('transaksi'));
    }

    public function tickets()
    {
        $pembeli = auth()->user()->pembeli;

        $tickets = Tiket::whereHas('pemesanan.transaksi', function($query) use ($pembeli) {
            $query->where('pembeli_id', $pembeli?->id);
        })
        ->orderByDesc('created_at')
        ->paginate(10);

        return view('dashboard.tickets', compact('tickets'));
    }

    public function downloadTicket($tiketId)
    {
        $ticket = Tiket::find($tiketId);

        if (!$ticket || $ticket->pemesanan->transaksi->pembeli->user_id !== auth()->id()) {
            abort(403, 'Anda tidak berhak mengakses tiket ini');
        }

        // Generate PDF or show ticket
        return view('ticket.show', compact('ticket'));
    }
}
