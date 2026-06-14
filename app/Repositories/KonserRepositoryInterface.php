<?php

namespace App\Repositories;

interface KonserRepositoryInterface
{
    /**
     * Get all active concerts
     */
    public function getAllActive($limit = null);

    /**
     * Get popular concerts with count
     */
    public function getPopular($limit = 4);

    /**
     * Get upcoming concerts
     */
    public function getUpcoming($limit = 4);

    /**
     * Search concerts
     */
    public function search($query);

    /**
     * Get concert with relations
     */
    public function getWithRelations($id);

    /**
     * Get concert by ID
     */
    public function findById($id);

    /**
     * Get concerts with filters
     */
    public function getFiltered($filters = []);
}
