<?php

namespace App\Repositories;

use App\Models\Konser;

class KonserRepository implements KonserRepositoryInterface
{
    protected $model;

    public function __construct(Konser $model)
    {
        $this->model = $model;
    }

    /**
     * Get all active concerts
     */
    public function getAllActive($limit = null)
    {
        $query = $this->model
            ->where('status_konser', 'aktif')
            ->with(['artis', 'kategoriTiket']);

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }

    /**
     * Get popular concerts with count
     */
    public function getPopular($limit = 4)
    {
        return $this->model
            ->where('status_konser', 'aktif')
            ->with(['artis', 'kategoriTiket'])
            ->withCount('pemesanan')
            ->orderByDesc('pemesanan_count')
            ->take($limit)
            ->get();
    }

    /**
     * Get upcoming concerts
     */
    public function getUpcoming($limit = 4)
    {
        return $this->model
            ->where('status_konser', 'aktif')
            ->where('tanggal_konser', '>=', now())
            ->with(['artis', 'kategoriTiket'])
            ->orderBy('tanggal_konser', 'asc')
            ->take($limit)
            ->get();
    }

    /**
     * Search concerts
     */
    public function search($query)
    {
        return $this->model
            ->where('status_konser', 'aktif')
            ->where(function ($q) use ($query) {
                $q->where('nama_konser', 'like', '%' . $query . '%')
                  ->orWhere('lokasi', 'like', '%' . $query . '%')
                  ->orWhereHas('artis', function ($subQ) use ($query) {
                      $subQ->where('nama_artis', 'like', '%' . $query . '%');
                  });
            })
            ->with(['artis', 'kategoriTiket'])
            ->paginate(12);
    }

    /**
     * Get concert with relations
     */
    public function getWithRelations($id)
    {
        return $this->model
            ->with(['artis', 'kategoriTiket'])
            ->findOrFail($id);
    }

    /**
     * Get concert by ID
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get concerts with filters
     */
    public function getFiltered($filters = [])
    {
        $query = $this->model
            ->where('status_konser', 'aktif')
            ->with(['artis', 'kategoriTiket']);

        if (isset($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('nama_konser', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('lokasi', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (isset($filters['lokasi'])) {
            $query->where('lokasi', $filters['lokasi']);
        }

        if (isset($filters['date']) && $filters['date']) {
            $query->where('tanggal_konser', '>=', $filters['date']);
        }

        return $query->paginate(12);
    }
}
