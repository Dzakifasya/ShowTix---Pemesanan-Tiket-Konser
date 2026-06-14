<?php

namespace App\Repositories;

interface PembeliRepositoryInterface
{
    /**
     * Find or create buyer
     */
    public function findOrCreate($data);

    /**
     * Get buyer by ID
     */
    public function findById($id);

    /**
     * Get buyer by email
     */
    public function findByEmail($email);

    /**
     * Create new buyer
     */
    public function create($data);

    /**
     * Update buyer
     */
    public function update($id, $data);

    /**
     * Get all buyers
     */
    public function getAll();
}
