<?php

namespace App\Repositories;

use App\Models\Pemesanan;

class PemesananRepository implements PemesananRepositoryInterface
{
    protected $model;

    public function __construct(Pemesanan $model)
    {
        $this->model = $model;
    }

    /**
     * Create booking
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * Get booking by ID
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get bookings by buyer ID
     */
    public function getByBuyerId($pembeli_id)
    {
        return $this->model
            ->where('pembeli_id', $pembeli_id)
            ->with(['kategoriTiket.konser'])
            ->orderByDesc('created_at')
            ->get();
    }

    /**
     * Update booking status
     */
    public function updateStatus($id, $status)
    {
        $pemesanan = $this->model->findOrFail($id);
        $pemesanan->update(['status' => $status]);
        return $pemesanan;
    }

    /**
     * Get all bookings
     */
    public function getAll()
    {
        return $this->model
            ->with(['pembeli', 'kategoriTiket.konser'])
            ->paginate(15);
    }

    /**
     * Get pending bookings
     */
    public function getPending()
    {
        return $this->model
            ->where('status', 'pending')
            ->with(['pembeli', 'kategoriTiket.konser'])
            ->get();
    }
}
