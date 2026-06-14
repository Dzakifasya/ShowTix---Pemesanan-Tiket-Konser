<?php

namespace App\Repositories;

use App\Models\Pembeli;

class PembeliRepository implements PembeliRepositoryInterface
{
    protected $model;

    public function __construct(Pembeli $model)
    {
        $this->model = $model;
    }

    /**
     * Find or create buyer
     */
    public function findOrCreate($data)
    {
        return $this->model->updateOrCreate(
            ['email' => $data['email']],
            $data
        );
    }

    /**
     * Get buyer by ID
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get buyer by email
     */
    public function findByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Create new buyer
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * Update buyer
     */
    public function update($id, $data)
    {
        $pembeli = $this->model->findOrFail($id);
        $pembeli->update($data);
        return $pembeli;
    }

    /**
     * Get all buyers
     */
    public function getAll()
    {
        return $this->model->all();
    }
}
