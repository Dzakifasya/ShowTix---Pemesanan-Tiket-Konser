<?php

namespace App\Services;

class LocationService
{
    /**
     * Get list of Indonesian provinces
     */
    public static function getProvinces()
    {
        return [
            'aceh' => 'Aceh',
            'bali' => 'Bali',
            'banten' => 'Banten',
            'bengkulu' => 'Bengkulu',
            'dki_jakarta' => 'DKI Jakarta',
            'gorontalo' => 'Gorontalo',
            'jambi' => 'Jambi',
            'jawa_barat' => 'Jawa Barat',
            'jawa_tengah' => 'Jawa Tengah',
            'jawa_timur' => 'Jawa Timur',
            'kepulauan_bangka_belitung' => 'Kepulauan Bangka Belitung',
            'kepulauan_riau' => 'Kepulauan Riau',
            'lampung' => 'Lampung',
            'maluku' => 'Maluku',
            'maluku_utara' => 'Maluku Utara',
            'nusa_tenggara_barat' => 'Nusa Tenggara Barat',
            'nusa_tenggara_timur' => 'Nusa Tenggara Timur',
            'papua' => 'Papua',
            'papua_barat' => 'Papua Barat',
            'riau' => 'Riau',
            'sulawesi_barat' => 'Sulawesi Barat',
            'sulawesi_selatan' => 'Sulawesi Selatan',
            'sulawesi_tengah' => 'Sulawesi Tengah',
            'sulawesi_tenggara' => 'Sulawesi Tenggara',
            'sulawesi_utara' => 'Sulawesi Utara',
            'sumatera_barat' => 'Sumatera Barat',
            'sumatera_selatan' => 'Sumatera Selatan',
            'sumatera_utara' => 'Sumatera Utara',
            'yogyakarta' => 'Yogyakarta',
        ];
    }

    /**
     * Get destination list with coordinates
     */
    public static function getDestinations()
    {
        return [
            [
                'id' => 1,
                'name' => 'Indonesia',
                'image' => '/images/destinations/indonesia.jpg',
                'featured_event' => 'SNAP 2026',
                'latitude' => -6.2088,
                'longitude' => 106.8456,
            ],
            [
                'id' => 2,
                'name' => 'Singapore',
                'image' => '/images/destinations/singapore.jpg',
                'featured_event' => 'Asia Music Festival',
                'latitude' => 1.3521,
                'longitude' => 103.8198,
            ],
            [
                'id' => 3,
                'name' => 'Malaysia',
                'image' => '/images/destinations/malaysia.jpg',
                'featured_event' => 'Kuala Lumpur Music Week',
                'latitude' => 3.1390,
                'longitude' => 101.6869,
            ],
            [
                'id' => 4,
                'name' => 'South Korea',
                'image' => '/images/destinations/korea.jpg',
                'featured_event' => 'Seoul Music Festival',
                'latitude' => 37.5665,
                'longitude' => 126.9780,
            ],
            [
                'id' => 5,
                'name' => 'Japan',
                'image' => '/images/destinations/japan.jpg',
                'featured_event' => 'Tokyo Music Expo',
                'latitude' => 35.6762,
                'longitude' => 139.6503,
            ],
        ];
    }

    /**
     * Get coordinates for a location (hardcoded, can be replaced with API)
     */
    public static function getCoordinates($locationName)
    {
        $coordinates = [
            'jakarta' => ['lat' => -6.2088, 'lng' => 106.8456],
            'surabaya' => ['lat' => -7.2575, 'lng' => 112.7521],
            'bandung' => ['lat' => -6.9175, 'lng' => 107.6062],
            'medan' => ['lat' => 3.5952, 'lng' => 98.6722],
            'yogyakarta' => ['lat' => -7.7975, 'lng' => 110.3695],
            'bali' => ['lat' => -8.6705, 'lng' => 115.2126],
            'makassar' => ['lat' => -5.3520, 'lng' => 119.4327],
            'semarang' => ['lat' => -6.9674, 'lng' => 110.4161],
        ];

        $normalized = strtolower(str_replace([' ', '-', '_'], '', $locationName));
        
        foreach ($coordinates as $key => $coord) {
            if (strpos($normalized, str_replace([' ', '-', '_'], '', $key)) !== false) {
                return $coord;
            }
        }

        // Default to Jakarta
        return ['lat' => -6.2088, 'lng' => 106.8456];
    }

    /**
     * Format location for display
     */
    public static function formatLocation($city, $province = null)
    {
        if ($province) {
            return "{$city}, {$province}";
        }
        return $city;
    }

    /**
     * Get Google Maps embed URL
     */
    public static function getMapEmbedUrl($locationName, $apiKey = null)
    {
        $query = urlencode($locationName);
        $apiKey = $apiKey ?? config('services.google.maps_api_key');

        return "https://maps.google.com/maps?q={$query}&t=&z=13&ie=UTF8&iwloc=&output=embed";
    }
}
