<?php

namespace App\Repositories;

interface PemesananRepositoryInterface
{
    /**
     * Create booking
     */
    public function create($data);

    /**
     * Get booking by ID
     */
    public function findById($id);

    /**
     * Get bookings by buyer ID
     */
    public function getByBuyerId($pembeli_id);

    /**
     * Update booking status
     */
    public function updateStatus($id, $status);

    /**
     * Get all bookings
     */
    public function getAll();

    /**
     * Get pending bookings
     */
    public function getPending();
}
