<?php

namespace App\Entity;

use App\Repository\FeatureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FeatureRepository::class)
 */
class Feature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $description;

    /**
     * @ORM\ManyToOne(targetEntity=Casino::class, inversedBy="benefits", fetch="EAGER")
     * @ORM\JoinColumn(nullable=true)
     */
    private ?Casino $casinoBenefits;

    /**
     * @ORM\ManyToOne(targetEntity=Casino::class, inversedBy="limitations", fetch="EAGER")
     * @ORM\JoinColumn(nullable=true)
     */
    private ?Casino $casinoLimitations;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCasinoBenefits(): ?Casino
    {
        return $this->casinoBenefits;
    }

    public function setCasinoBenefits(?Casino $casinoBenefits): self
    {
        $this->casinoBenefits = $casinoBenefits;

        return $this;
    }

    public function getCasinoLimitations(): ?Casino
    {
        return $this->casinoLimitations;
    }

    public function setCasinoLimitations(?Casino $casinoLimitations): self
    {
        $this->casinoLimitations = $casinoLimitations;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->description;
    }
}
