<?php

namespace App\Entity;

use App\Repository\CasinoRatingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CasinoRatingRepository::class)
 */
class CasinoRating
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=RatingsRate::class, mappedBy="casinoRating", cascade={"persist"}))
     */
    private $ratingsCasinosRates;

    public function __construct()
    {
        $this->ratingsCasinosRates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getRatingsCasinosRates(): Collection
    {
        return $this->ratingsCasinosRates;
    }

    public function addRatingsCasinosRate(RatingsRate $ratingsRate): self
    {
        if (!$this->ratingsCasinosRates->contains($ratingsRate)) {

            $this->ratingsCasinosRates[] = $ratingsRate;
        }

        return $this;
    }

    public function removeRatingsCasinosRate(RatingsRate $ratingsRate): self
    {
        $this->ratingsCasinosRates->removeElement($ratingsRate);

        return $this;
    }

    public function addRatingsCasinosRates(RatingsRate $ratingsRate): self
    {
        if (!$this->ratingsCasinosRates->contains($ratingsRate)) {
            $ratingsRate->setCasinoRating($this);
            $this->ratingsCasinosRates[] = $ratingsRate;
        }

        return $this;
    }

    public function removeRatingsCasinosRates(RatingsRate $ratingsRate): self
    {
        $this->ratingsCasinosRates->removeElement($ratingsRate);

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
