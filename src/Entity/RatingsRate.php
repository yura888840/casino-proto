<?php

namespace App\Entity;

use App\Repository\RatingsRateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RatingsRateRepository::class)
 */
class RatingsRate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $rate;

    /**
     * @ORM\ManyToOne(targetEntity=Casino::class, fetch="EAGER", inversedBy="ratingsRates", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private ?Casino $casino;

    /**
     * @ORM\ManyToOne(targetEntity=CasinoRating::class, fetch="EAGER", inversedBy="ratingsCasinosRates", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private ?CasinoRating $casinoRating;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getCasinoRating(): ?CasinoRating
    {
        return $this->casinoRating;
    }

    public function setCasinoRating(?CasinoRating $casinoRating): self
    {
        $this->casinoRating = $casinoRating;
        $casinoRating->addRatingsCasinosRate($this);

        return $this;
    }

    public function getCasino(): ?Casino
    {
        return $this->casino;
    }

    public function setCasino(?Casino $casino): self
    {
        $this->casino = $casino;

        $casino?->addRatingsRate($this);

        return $this;
    }

    public function __toString(): string
    {
        return sprintf(
            '%s - %s - %d',
            $this->casinoRating ? $this->casinoRating->getName() : ' ',
            $this->casino ? $this->casino->getName() : ' ',
            $this->rate
        );
    }
}
