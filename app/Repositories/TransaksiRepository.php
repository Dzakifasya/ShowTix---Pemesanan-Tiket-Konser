<?php

namespace App\Repositories;

use App\Models\Transaksi;

class TransaksiRepository implements TransaksiRepositoryInterface
{
    protected $model;

    public function __construct(Transaksi $model)
    {
        $this->model = $model;
    }

    /**
     * Create transaction
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * Get transaction by ID
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get transaction by pemesanan ID
     */
    public function getByPemesananId($pemesanan_id)
    {
        return $this->model
            ->where('pemesanan_id', $pemesanan_id)
            ->with(['pemesanan.pembeli', 'pemesanan.kategoriTiket.konser'])
            ->first();
    }

    /**
     * Update transaction status
     */
    public function updateStatus($id, $status)
    {
        $transaksi = $this->model->findOrFail($id);
        $transaksi->update(['status' => $status]);
        return $transaksi;
    }

    /**
     * Update payment code
     */
    public function updatePaymentCode($id, $code)
    {
        return $this->model->findOrFail($id)->update([
            'kode_pembayaran' => $code
        ]);
    }

    /**
     * Get pending transactions
     */
    public function getPending()
    {
        return $this->model
            ->where('status', 'pending')
            ->where('expired_at', '>', now())
            ->with(['pemesanan.pembeli', 'pemesanan.kategoriTiket.konser'])
            ->get();
    }

    /**
     * Check if transaction expired
     */
    public function isExpired($id)
    {
        $transaksi = $this->model->findOrFail($id);
        return $transaksi->expired_at < now();
    }

    /**
     * Get all transactions
     */
    public function getAll()
    {
        return $this->model
            ->with(['pemesanan.pembeli', 'pemesanan.kategoriTiket.konser'])
            ->paginate(15);
    }
}
