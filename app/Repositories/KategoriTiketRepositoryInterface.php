<?php

namespace App\Repositories;

interface KategoriTiketRepositoryInterface
{
    /**
     * Get all ticket categories
     */
    public function getAll();

    /**
     * Get tickets by concert ID
     */
    public function getByConcertId($konser_id);

    /**
     * Get ticket category by ID
     */
    public function findById($id);

    /**
     * Check ticket availability
     */
    public function isAvailable($id, $quantity);

    /**
     * Reduce ticket quota
     */
    public function reduceQuota($id, $quantity);

    /**
     * Update remaining quota
     */
    public function updateQuota($id, $quantity);
}
