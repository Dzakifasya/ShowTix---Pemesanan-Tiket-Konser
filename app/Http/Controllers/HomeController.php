<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get popular concerts (top selling) with ticket count
        $konserTerpopuler = Konser::where('status_konser', 'aktif')
            ->with(['artis', 'kategoriTiket'])
            ->withCount('pemesanan')
            ->orderByDesc('pemesanan_count')
            ->take(4)
            ->get();

        // Get upcoming concerts
        $konserMendatang = Konser::where('status_konser', 'aktif')
            ->where('tanggal_konser', '>=', now())
            ->with(['artis', 'kategoriTiket'])
            ->orderBy('tanggal_konser')
            ->paginate(8);

        return view('home', compact('konserTerpopuler', 'konserMendatang'));
    }

    public function search(Request $request)
    {
        $query = Konser::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_konser', 'LIKE', "%{$search}%")
                  ->orWhereHas('artis', function ($q) use ($search) {
                      $q->where('nama_artis', 'LIKE', "%{$search}%");
                  });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'LIKE', "%{$request->lokasi}%");
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_konser', $request->tanggal);
        }

        $konser = $query->where('status_konser', 'aktif')
                       ->paginate(12);

        return view('search', compact('konser'));
    }
}
