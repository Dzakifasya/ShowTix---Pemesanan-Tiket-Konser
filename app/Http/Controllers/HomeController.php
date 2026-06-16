<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use App\Services\LocationService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display homepage with featured events and destinations
     */
    public function index()
    {
        // Get banner/featured concerts (latest active ones)
        $banners = Konser::where('status_konser', 'aktif')
            ->with(['artis', 'kategoriTiket'])
            ->latest('created_at')
            ->take(5)
            ->get();

        // Get latest active concerts
        $latestConcerts = Konser::where('status_konser', 'aktif')
            ->with(['artis', 'kategoriTiket'])
            ->where('tanggal_konser', '>=', now()->subMonth())
            ->orderBy('tanggal_konser')
            ->paginate(8, ['*'], 'latest_page');

        // Get recommended concerts (most popular by orders)
        $recommendedConcerts = Konser::where('status_konser', 'aktif')
            ->with(['artis', 'kategoriTiket'])
            ->has('pemesanan')
            ->withCount('pemesanan')
            ->orderByDesc('pemesanan_count')
            ->take(6)
            ->get();

        // Get destinations
        $destinations = LocationService::getDestinations();

        // Get cart count from session
        $cartCount = session('cart_count', 0);

        // Align for Blade view variable names
        $konserMendatang = $latestConcerts;

        return view('home', compact(
            'banners',
            'latestConcerts',
            'recommendedConcerts',
            'destinations',
            'cartCount',
            'konserMendatang'
        ));
    }

    /**
     * Search concerts by name or location
     */
    public function search(Request $request)
    {
        $query = Konser::where('status_konser', 'aktif');
        $searchTerm = $request->input('search', '');
        $location = $request->input('location', '');

        // Search by concert name or artist
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama_konser', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('artis', function ($subQ) use ($searchTerm) {
                      $subQ->where('nama_artis', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        // Search by location
        if ($location) {
            $query->where('lokasi', 'LIKE', "%{$location}%");
        }

        $concerts = $query->with(['artis', 'kategoriTiket'])
                         ->orderBy('tanggal_konser')
                         ->paginate(12);

        // Assign to konser for search.blade.php
        $konser = $concerts;

        if ($request->wantsJson()) {
            return response()->json($concerts);
        }

        return view('search', compact('konser', 'searchTerm', 'location'));
    }
}
