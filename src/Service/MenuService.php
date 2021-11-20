<?php

namespace App\Service;

use App\Dto\MenuDto;
use App\Repository\CasinoRepository;
//MenuBuilder
class MenuService
{
    private CasinoRepository $casinoRepository;

    public function __construct(CasinoRepository $casinoRepository)
    {
        $this->casinoRepository = $casinoRepository;
    }

    //build
    public function fetchDataForMenu(): MenuDto
    {
        return new MenuDto(
            $this->casinoRepository->findCasinosByRating()
        );
    }

    //@todo move to another service / class
    //Rates / FetchCasinosByRates(Rate)
    public function fetchCasinosByRate()
    {
        return new MenuDto(
            $this->casinoRepository->findCasinosByRating()
        );
    }
}
