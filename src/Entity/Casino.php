<?php

namespace App\Entity;

use App\Repository\CasinoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CasinoRepository::class)
 */
class Casino
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
    private ?string $logo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $imgRating;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $img300;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $shortDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $linkToPartner;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $method;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $soft;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $bonus;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $license;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $year;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $support;

    /**
     * @ORM\OneToOne(targetEntity=Page::class, inversedBy="casino", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private ?Page $page;

    /**
     * @ORM\OneToMany(targetEntity=Feature::class, mappedBy="casinoBenefits",cascade={"persist"})
     */
    private Collection $benefits;

    /**
     * @ORM\OneToMany(targetEntity=Feature::class, mappedBy="casinoLimitations", cascade={"persist"})
     */
    private Collection $limitations;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $rating;

    /**
     * @ORM\OneToMany(targetEntity=RatingsRate::class, mappedBy="casino", cascade={"persist"}, orphanRemoval=true)
     */
    private $ratingsRates;

    public function __construct()
    {
        $this->benefits = new ArrayCollection();
        $this->limitations = new ArrayCollection();
        $this->ratingsRates = new ArrayCollection();
        $this->casinoRatings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
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

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setMethod(?string $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function getSoft(): ?string
    {
        return $this->soft;
    }

    public function setSoft(?string $soft): self
    {
        $this->soft = $soft;

        return $this;
    }

    public function getBonus(): ?string
    {
        return $this->bonus;
    }

    public function setBonus(?string $bonus): self
    {
        $this->bonus = $bonus;

        return $this;
    }

    public function getLicense(): ?string
    {
        return $this->license;
    }

    public function setLicense(?string $license): self
    {
        $this->license = $license;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(?string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getSupport(): ?string
    {
        return $this->support;
    }

    public function setSupport(?string $support): self
    {
        $this->support = $support;

        return $this;
    }

    public function getPage(): ?Page
    {
        return $this->page;
    }

    public function setPage(Page $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return Collection|Feature[]
     */
    public function getBenefits(): Collection
    {
        return $this->benefits;
    }

    public function addBenefit(Feature $feature): self
    {
        if (!$this->benefits->contains($feature)) {
            $this->benefits[] = $feature;
            $feature->setCasinoBenefits($this);
        }

        return $this;
    }

    public function removeBenefit(Feature $feature): self
    {
        if ($this->benefits->removeElement($feature)) {
            // set the owning side to null (unless already changed)
            if ($feature->getCasinoBenefits() === $this) {
                $feature->setCasinoBenefits(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Feature[]
     */
    public function getLimitations(): Collection
    {
        return $this->limitations;
    }

    public function addLimitation(Feature $feature): self
    {
        if (!$this->limitations->contains($feature)) {
            $this->limitations[] = $feature;
            $feature->setCasinoLimitations($this);
        }

        return $this;
    }

    public function removeLimitation(Feature $feature): self
    {
        if ($this->limitations->removeElement($feature)) {
            // set the owning side to null (unless already changed)
            if ($feature->getCasinoLimitations() === $this) {
                $feature->setCasinoLimitations(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @param mixed $shortDescription
     */
    public function setShortDescription($shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLinkToPartner()
    {
        return $this->linkToPartner;
    }

    /**
     * @param mixed $linkToPartner
     */
    public function setLinkToPartner($linkToPartner): self
    {
        $this->linkToPartner = $linkToPartner;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->name;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return string|null
     */
    public function getImgRating(): ?string
    {
        return $this->imgRating;
    }

    /**
     * @param string|null $imgRating
     */
    public function setImgRating(?string $imgRating): void
    {
        $this->imgRating = $imgRating;
    }

    /**
     * @return string|null
     */
    public function getImg300(): ?string
    {
        return $this->img300;
    }

    /**
     * @param string|null $img300
     */
    public function setImg300(?string $img300): void
    {
        $this->img300 = $img300;
    }


    /**
     * @return Collection|RatingsRate[]
     */
    public function getRatingsRates(): Collection
    {
        return $this->ratingsRates;
    }

    public function addRatingsRate(RatingsRate $ratingsRate): self
    {
        if (!$this->ratingsRates->contains($ratingsRate)) {
            $this->ratingsRates[] = $ratingsRate;
            $ratingsRate->setCasino($this);
        }

        return $this;
    }

    public function removeRatingsRate(RatingsRate $ratingsRate): self
    {
        if ($this->ratingsRates->removeElement($ratingsRate)) {
            // set the owning side to null (unless already changed)
            if ($ratingsRate->getCasino() === $this) {
                $ratingsRate->setCasino(null);
            }
        }

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCasinoRatings(): ArrayCollection
    {
        return $this->casinoRatings;
    }

    /**
     * @param ArrayCollection $casinoRatings
     */
    public function setCasinoRatings(ArrayCollection $casinoRatings): void
    {
        $this->casinoRatings = $casinoRatings;
    }
}
