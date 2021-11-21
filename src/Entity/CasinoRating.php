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
    private $name = '';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $title = '';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $description = '';

    /**
     * @ORM\Column(type="text")
     */
    private ?string $keywords = '';

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $addition = '';

    /**
     * @ORM\Column(type="text")
     */
    private ?string $content1 = '';

    /**
     * @ORM\Column(type="text")
     */
    private ?string $content2 = '';

    /**
     * @ORM\Column(type="boolean", nullable="true", options={"default": true})
     * @var boolean
     */
    private bool $active = true;

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

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    /**
     * @param string|null $keywords
     */
    public function setKeywords(?string $keywords): void
    {
        $this->keywords = $keywords;
    }

    /**
     * @return string|null
     */
    public function getAddition(): ?string
    {
        return $this->addition;
    }

    /**
     * @param string|null $addition
     */
    public function setAddition(?string $addition): void
    {
        $this->addition = $addition;
    }

    /**
     * @return string|null
     */
    public function getContent1(): ?string
    {
        return $this->content1;
    }

    /**
     * @param string|null $content1
     */
    public function setContent1(?string $content1): void
    {
        $this->content1 = $content1;
    }

    /**
     * @return string|null
     */
    public function getContent2(): ?string
    {
        return $this->content2;
    }

    /**
     * @param string|null $content2
     */
    public function setContent2(?string $content2): void
    {
        $this->content2 = $content2;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function __toString()
    {
        return $this->name;
    }
}
