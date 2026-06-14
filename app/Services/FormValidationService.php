<?php

namespace App\Services;

class FormValidationService
{
    /**
     * Validate email format and provide error message
     */
    public static function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [
                'valid' => false,
                'message' => 'Format email tidak valid',
            ];
        }

        return [
            'valid' => true,
            'message' => 'Email valid',
        ];
    }

    /**
     * Validate email confirmation
     */
    public static function validateEmailConfirmation($email, $confirmation)
    {
        if ($email !== $confirmation) {
            return [
                'valid' => false,
                'message' => 'Email tidak cocok',
            ];
        }

        return [
            'valid' => true,
            'message' => 'Email cocok',
        ];
    }

    /**
     * Validate phone number
     */
    public static function validatePhoneNumber($phone)
    {
        // Remove common formats
        $cleaned = preg_replace('/[^0-9]/', '', $phone);

        // Check if starts with 62 or 0
        if (substr($cleaned, 0, 2) === '62') {
            // Remove 62 prefix for consistency
            $cleaned = substr($cleaned, 2);
        } elseif (substr($cleaned, 0, 1) === '0') {
            // Remove leading 0
            $cleaned = substr($cleaned, 1);
        } else {
            return [
                'valid' => false,
                'message' => 'Format nomor WhatsApp tidak valid. Gunakan format 08xx atau +628xx',
            ];
        }

        // Check length (Indonesian mobile numbers are 9-12 digits after prefix removal)
        if (strlen($cleaned) < 9 || strlen($cleaned) > 12) {
            return [
                'valid' => false,
                'message' => 'Nomor WhatsApp harus 9-12 digit',
            ];
        }

        return [
            'valid' => true,
            'message' => 'Nomor WhatsApp valid',
            'formatted' => '+62' . $cleaned,
        ];
    }

    /**
     * Validate date of birth
     */
    public static function validateDateOfBirth($dateString)
    {
        try {
            $date = \Carbon\Carbon::parse($dateString);
            $now = \Carbon\Carbon::now();
            
            // Check if date is in the past
            if ($date->isFuture()) {
                return [
                    'valid' => false,
                    'message' => 'Tanggal lahir tidak boleh di masa depan',
                ];
            }

            // Check if age is at least 5 years old
            $age = $now->diffInYears($date);
            if ($age < 5) {
                return [
                    'valid' => false,
                    'message' => 'Anda harus minimal 5 tahun',
                ];
            }

            // Check if age is reasonable (max 120 years)
            if ($age > 120) {
                return [
                    'valid' => false,
                    'message' => 'Tanggal lahir tidak valid',
                ];
            }

            return [
                'valid' => true,
                'message' => "Usia: {$age} tahun",
                'age' => $age,
            ];
        } catch (\Exception $e) {
            return [
                'valid' => false,
                'message' => 'Format tanggal tidak valid',
            ];
        }
    }

    /**
     * Validate full name
     */
    public static function validateFullName($name)
    {
        $trimmed = trim($name);
        
        if (strlen($trimmed) < 3) {
            return [
                'valid' => false,
                'message' => 'Nama minimal 3 karakter',
            ];
        }

        if (strlen($trimmed) > 100) {
            return [
                'valid' => false,
                'message' => 'Nama maksimal 100 karakter',
            ];
        }

        // Check if contains only letters, spaces, and common name characters
        if (!preg_match('/^[a-zA-Z\s\-\.\'àáâãäåèéêëìíîïòóôõöùúûüýÿœæÀÁÂÃÄÅÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝŸŒÆ]+$/', $trimmed)) {
            return [
                'valid' => false,
                'message' => 'Nama hanya boleh mengandung huruf, spasi, dan karakter khusus (-.\\')',
            ];
        }

        return [
            'valid' => true,
            'message' => 'Nama valid',
        ];
    }

    /**
     * Validate gender selection
     */
    public static function validateGender($gender)
    {
        $validGenders = ['laki-laki', 'perempuan', 'other'];

        if (!in_array($gender, $validGenders)) {
            return [
                'valid' => false,
                'message' => 'Pilih jenis kelamin yang valid',
            ];
        }

        return [
            'valid' => true,
            'message' => 'Jenis kelamin valid',
        ];
    }

    /**
     * Validate province selection
     */
    public static function validateProvince($province)
    {
        $provinces = LocationService::getProvinces();

        if (!array_key_exists($province, $provinces)) {
            return [
                'valid' => false,
                'message' => 'Pilih provinsi yang valid',
            ];
        }

        return [
            'valid' => true,
            'message' => 'Provinsi valid',
        ];
    }

    /**
     * Get all validation errors for a field
     */
    public static function validateField($field, $value)
    {
        $validations = [
            'nama_lengkap' => fn($v) => self::validateFullName($v),
            'email' => fn($v) => self::validateEmail($v),
            'email_confirmation' => fn($v) => self::validateEmail($v),
            'no_whatsapp' => fn($v) => self::validatePhoneNumber($v),
            'jenis_kelamin' => fn($v) => self::validateGender($v),
            'provinsi' => fn($v) => self::validateProvince($v),
            'tanggal_lahir' => fn($v) => self::validateDateOfBirth($v),
        ];

        if (isset($validations[$field])) {
            return $validations[$field]($value);
        }

        return [
            'valid' => true,
            'message' => 'Valid',
        ];
    }
}
