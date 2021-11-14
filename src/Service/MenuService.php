<?php

namespace App\Service;

use App\Dto\MenuDto;
use App\Repository\CasinoRepository;

class MenuService
{
    private CasinoRepository $casinoRepository;

    public function __construct(CasinoRepository $casinoRepository)
    {
        $this->casinoRepository = $casinoRepository;
    }

    public function fetchDataForMenu(): MenuDto
    {
        return new MenuDto(
            $this->casinoRepository->findCasinosByRating()
        );
    }

    //@todo move to another service / class
    public function fetchCasinosByRate()
    {
        return new MenuDto(
            $this->casinoRepository->findCasinosByRating()
        );
    }
}
