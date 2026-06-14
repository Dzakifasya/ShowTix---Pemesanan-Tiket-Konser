<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\KategoriTiket;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    public function detail($id)
    {
        $konser = Konser::with(['artis', 'kategoriTiket'])
                       ->findOrFail($id);

        // Calculate remaining tickets
        $konser->sisa_tiket = $konser->kategoriTiket
                                    ->sum('sisa_kuota');

        return view('concerts.detail', compact('konser'));
    }

    public function getKategoriTiket($koncertId)
    {
        $kategoriTiket = KategoriTiket::where('konser_id', $koncertId)
                                      ->where('sisa_kuota', '>', 0)
                                      ->get();

        return response()->json($kategoriTiket);
    }
}
