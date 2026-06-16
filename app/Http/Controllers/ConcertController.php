<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\KategoriTiket;
use App\Services\LocationService;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    /**
     * Display concert detail page
     */
    public function detail($id)
    {
        $concert = Konser::with(['artis', 'kategoriTiket'])
                        ->findOrFail($id);

        // Get artist information
        $artists = $concert->artis()->get();

        // Get ticket categories with availability
        $ticketCategories = $concert->kategoriTiket()
                                   ->where('sisa_kuota', '>', 0)
                                   ->get();

        // Get location coordinates for maps
        $coordinates = LocationService::getCoordinates($concert->lokasi);
        $mapsUrl = LocationService::getMapEmbedUrl($concert->lokasi);

        // Get cart count from session
        $cartCount = session('cart_count', 0);

        return view('events.detail', compact(
            'concert',
            'artists',
            'ticketCategories',
            'coordinates',
            'mapsUrl',
            'cartCount'
        ));
    }

    /**
     * Get ticket categories via AJAX
     */
    public function getTicketCategories($id)
    {
        $categories = KategoriTiket::where('konser_id', $id)
                                  ->where('sisa_kuota', '>', 0)
                                  ->select('id', 'nama_kategori', 'harga', 'sisa_kuota')
                                  ->get();

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }

    /**
     * Get concert details via AJAX
     */
    public function getConcertDetails($id)
    {
        $concert = Konser::with(['artis', 'kategoriTiket'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $concert->id,
                'nama_konser' => $concert->nama_konser,
                'tanggal' => $concert->tanggal_konser->format('d M Y'),
                'waktu' => $concert->waktu_konser ? $concert->waktu_konser->format('H:i') : 'Belum ditentukan',
                'lokasi' => $concert->lokasi,
                'poster' => $concert->poster ? asset('storage/' . $concert->poster) : null,
                'artists' => $concert->artis->pluck('nama_artis')->implode(', '),
                'minPrice' => $concert->kategoriTiket->min('harga'),
                'totalTickets' => $concert->kategoriTiket->sum('sisa_kuota'),
            ],
        ]);
    }
}
