<?php

namespace App\Services;

use App\Models\Pembayaran;
use App\Models\Transaksi;
use Carbon\Carbon;

class PaymentService
{
    /**
     * Payment methods with logos and details
     */
    public static function getPaymentMethods()
    {
        return [
            [
                'id' => 'bca_va',
                'name' => 'BCA Virtual Account',
                'icon' => 'bca',
                'description' => 'Kirim dana ke nomor virtual account BCA kami',
                'fee_percentage' => 0,
                'fee_fixed' => 0,
            ],
            [
                'id' => 'bni_va',
                'name' => 'BNI Virtual Account',
                'icon' => 'bni',
                'description' => 'Kirim dana ke nomor virtual account BNI kami',
                'fee_percentage' => 0,
                'fee_fixed' => 0,
            ],
            [
                'id' => 'bri_va',
                'name' => 'BRI Virtual Account',
                'icon' => 'bri',
                'description' => 'Kirim dana ke nomor virtual account BRI kami',
                'fee_percentage' => 0,
                'fee_fixed' => 0,
            ],
            [
                'id' => 'mandiri_va',
                'name' => 'Mandiri Virtual Account',
                'icon' => 'mandiri',
                'description' => 'Kirim dana ke nomor virtual account Mandiri kami',
                'fee_percentage' => 0,
                'fee_fixed' => 0,
            ],
            [
                'id' => 'permata_va',
                'name' => 'Bank Permata VA',
                'icon' => 'permata',
                'description' => 'Kirim dana ke nomor virtual account Permata kami',
                'fee_percentage' => 0,
                'fee_fixed' => 0,
            ],
            [
                'id' => 'sinarmas_va',
                'name' => 'Bank Sinarmas VA',
                'icon' => 'sinarmas',
                'description' => 'Kirim dana ke nomor virtual account Sinarmas kami',
                'fee_percentage' => 0,
                'fee_fixed' => 0,
            ],
            [
                'id' => 'muamalat_va',
                'name' => 'Bank Muamalat VA',
                'icon' => 'muamalat',
                'description' => 'Kirim dana ke nomor virtual account Muamalat kami',
                'fee_percentage' => 0,
                'fee_fixed' => 0,
            ],
            [
                'id' => 'qris',
                'name' => 'QRIS',
                'icon' => 'qris',
                'description' => 'Scan QR Code untuk membayar dengan e-wallet pilihan Anda',
                'fee_percentage' => 0,
                'fee_fixed' => 0,
            ],
        ];
    }

    /**
     * Generate unique payment code
     */
    public static function generatePaymentCode($method, $transaksiId)
    {
        $prefix = strtoupper(substr($method, 0, 3));
        $timestamp = now()->format('YmdHis');
        $random = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        return "{$prefix}{$timestamp}{$random}";
    }

    /**
     * Generate virtual account number for VA methods
     */
    public static function generateVirtualAccount($bankCode, $transaksiId)
    {
        // Format: Bank Code + Transaksi ID + Random 3 digits
        $random = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        return "{$bankCode}{$transaksiId}{$random}";
    }

    /**
     * Calculate payment fee based on method
     */
    public static function calculateServiceFee($amount, $method)
    {
        $methods = self::getPaymentMethods();
        $selectedMethod = collect($methods)->firstWhere('id', $method);
        
        if (!$selectedMethod) {
            return 0;
        }

        $feePercentage = $selectedMethod['fee_percentage'];
        $feeFixed = $selectedMethod['fee_fixed'];

        return ($amount * $feePercentage / 100) + $feeFixed;
    }

    /**
     * Create payment record
     */
    public static function createPayment(Transaksi $transaksi, $method, $serviceCharge)
    {
        $paymentCode = self::generatePaymentCode($method, $transaksi->id);
        $totalBayar = $transaksi->total_harga + $serviceCharge;

        $pembayaran = Pembayaran::create([
            'transaksi_id' => $transaksi->id,
            'metode_pembayaran' => $method,
            'kode_pembayaran' => $paymentCode,
            'jumlah_bayar' => $totalBayar,
            'biaya_layanan' => $serviceCharge,
            'status_pembayaran' => 'pending',
        ]);

        // Update transaksi status
        $transaksi->update([
            'status_transaksi' => 'pending_payment',
            'expired_at' => now()->addMinutes(10),
        ]);

        return $pembayaran;
    }

    /**
     * Get payment expiry time in seconds
     */
    public static function getPaymentExpirySeconds(Transaksi $transaksi)
    {
        $now = now();
        $expiry = $transaksi->expired_at;

        if ($expiry && $now < $expiry) {
            return $expiry->diffInSeconds($now);
        }

        return 0;
    }

    /**
     * Check if payment is expired
     */
    public static function isPaymentExpired(Transaksi $transaksi)
    {
        return $transaksi->expired_at && now() > $transaksi->expired_at;
    }

    /**
     * Mark payment as successful
     */
    public static function markPaymentSuccessful(Pembayaran $pembayaran)
    {
        $pembayaran->update([
            'status_pembayaran' => 'success',
        ]);

        $pembayaran->transaksi()->update([
            'status_transaksi' => 'completed',
        ]);

        return $pembayaran;
    }

    /**
     * Get payment method details
     */
    public static function getMethodDetails($methodId)
    {
        return collect(self::getPaymentMethods())->firstWhere('id', $methodId);
    }

    /**
     * Format payment code display
     */
    public static function formatPaymentCode($code, $method)
    {
        // Add spaces for readability
        if (in_array($method, ['bca_va', 'bni_va', 'bri_va', 'mandiri_va', 'permata_va', 'sinarmas_va', 'muamalat_va'])) {
            // Virtual account format: XXXX XXXX XXXX XXXX XXXX
            return implode(' ', str_split($code, 4));
        }

        return $code;
    }
}
