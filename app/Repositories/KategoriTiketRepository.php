<?php

namespace App\Repositories;

use App\Models\KategoriTiket;

class KategoriTiketRepository implements KategoriTiketRepositoryInterface
{
    protected $model;

    public function __construct(KategoriTiket $model)
    {
        $this->model = $model;
    }

    /**
     * Get all ticket categories
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Get tickets by concert ID
     */
    public function getByConcertId($konser_id)
    {
        return $this->model
            ->where('konser_id', $konser_id)
            ->get();
    }

    /**
     * Get ticket category by ID
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Check ticket availability
     */
    public function isAvailable($id, $quantity)
    {
        $ticket = $this->model->findOrFail($id);
        return $ticket->sisa_kuota >= $quantity;
    }

    /**
     * Reduce ticket quota
     */
    public function reduceQuota($id, $quantity)
    {
        $ticket = $this->model->findOrFail($id);
        
        if ($ticket->sisa_kuota < $quantity) {
            throw new \Exception('Tiket yang tersedia tidak cukup');
        }

        $ticket->update([
            'sisa_kuota' => $ticket->sisa_kuota - $quantity
        ]);

        return $ticket;
    }

    /**
     * Update remaining quota
     */
    public function updateQuota($id, $quantity)
    {
        return $this->model->findOrFail($id)->update([
            'sisa_kuota' => $quantity
        ]);
    }
}
