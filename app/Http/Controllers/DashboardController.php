<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DashboardController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(function ($request, $next) {
                if (auth()->check() && auth()->user()->is_admin()) {
                    return redirect('/admin');
                }
                return $next($request);
            }),
        ];
    }

    public function index()
    {
        $user = auth()->user();
        
        // Get user's pembeli info
        $pembeli = $user->pembeli;

        // Get transactions
        $transaksi = Transaksi::where('pembeli_id', $pembeli?->id)
                             ->orderByDesc('created_at')
                             ->paginate(10);

        // Fetch all transactions for calculating statistics
        $allTransaksi = Transaksi::where('pembeli_id', $pembeli?->id)->get();
        
        // Filter completed/successful transactions (case-insensitive for 'completed' and 'berhasil')
        $completedTransaksi = $allTransaksi->filter(fn($t) => 
            in_array(strtolower($t->status_transaksi), ['completed', 'berhasil'])
        );

        // Calculate statistics
        $totalBelanja = $completedTransaksi->sum('total_harga');
        
        $totalTiket = $completedTransaksi->flatMap(fn($t) => $t->pemesanan)->sum('jumlah_tiket');
        
        $totalKonser = $completedTransaksi->flatMap(fn($t) => $t->pemesanan)
            ->map(fn($p) => $p->kategoriTiket?->konser_id)
            ->filter()
            ->unique()
            ->count();

        $upcomingConcertsCount = $completedTransaksi->flatMap(fn($t) => $t->pemesanan)
            ->map(fn($p) => $p->kategoriTiket?->konser)
            ->filter(fn($k) => $k && \Carbon\Carbon::parse($k->tanggal_konser)->isFuture())
            ->unique('id')
            ->count();

        // Get actual upcoming concerts for the user
        $upcomingConcerts = $completedTransaksi->flatMap(fn($t) => $t->pemesanan)
            ->map(fn($p) => $p->kategoriTiket?->konser)
            ->filter(fn($k) => $k && \Carbon\Carbon::parse($k->tanggal_konser)->isFuture())
            ->unique('id');

        return view('dashboard.index', compact(
            'user', 
            'transaksi', 
            'upcomingConcerts',
            'totalBelanja',
            'totalTiket',
            'totalKonser',
            'upcomingConcertsCount'
        ));
    }

    public function profile()
    {
        return redirect()->route('dashboard', ['tab' => 'settings']);
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
        return redirect()->route('dashboard', ['tab' => 'history']);
    }

    public function tickets()
    {
        return redirect()->route('dashboard', ['tab' => 'upcoming']);
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
