<?php

namespace App\Dto;

//Move to - Services/Menu
class MenuDto
{
    private array $casinos;

    public function __construct($casinos)
    {
        $this->casinos = $casinos;
    }

    /**
     * @return array
     */
    public function getCasinos(): array
    {
        return $this->casinos;
    }

}
