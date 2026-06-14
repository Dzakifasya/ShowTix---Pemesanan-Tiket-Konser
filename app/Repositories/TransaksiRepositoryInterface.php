<?php

namespace App\Repositories;

interface TransaksiRepositoryInterface
{
    /**
     * Create transaction
     */
    public function create($data);

    /**
     * Get transaction by ID
     */
    public function findById($id);

    /**
     * Get transaction by pemesanan ID
     */
    public function getByPemesananId($pemesanan_id);

    /**
     * Update transaction status
     */
    public function updateStatus($id, $status);

    /**
     * Update payment code
     */
    public function updatePaymentCode($id, $code);

    /**
     * Get pending transactions
     */
    public function getPending();

    /**
     * Check if transaction expired
     */
    public function isExpired($id);

    /**
     * Get all transactions
     */
    public function getAll();
}
