<?php

namespace App\Services;

use App\Repositories\KonserRepositoryInterface;

class KonserService
{
    protected $konserRepository;

    public function __construct(KonserRepositoryInterface $konserRepository)
    {
        $this->konserRepository = $konserRepository;
    }

    /**
     * Get home page data
     */
    public function getHomePageData()
    {
        return [
            'konserTerpopuler' => $this->konserRepository->getPopular(4),
            'konserMendatang' => $this->konserRepository->getUpcoming(4),
        ];
    }

    /**
     * Get concert detail with all information
     */
    public function getConcertDetail($id)
    {
        return $this->konserRepository->getWithRelations($id);
    }

    /**
     * Search concerts
     */
    public function searchConcerts($query)
    {
        if (empty($query)) {
            return collect();
        }

        return $this->konserRepository->search($query);
    }

    /**
     * Get filtered concerts
     */
    public function getFilteredConcerts($filters)
    {
        return $this->konserRepository->getFiltered($filters);
    }

    /**
     * Get all active concerts
     */
    public function getActiveConcerts($limit = null)
    {
        return $this->konserRepository->getAllActive($limit);
    }
}
