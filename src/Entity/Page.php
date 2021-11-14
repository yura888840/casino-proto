<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageRepository::class)
 */
class Page
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
    private ?string $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $description;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $keywords;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $addition;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $content1;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $content2;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $contentTable;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @var boolean
     */
    private bool $main = false;

    /**
     * @ORM\OneToOne(targetEntity=Casino::class, mappedBy="page", cascade={"persist", "remove"})
     */
    private ?Casino $casino;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getAddition(): ?string
    {
        return $this->addition;
    }

    public function setAddition(?string $addition): self
    {
        $this->addition = $addition;

        return $this;
    }

    public function getContent1(): ?string
    {
        return $this->content1;
    }

    public function setContent1(string $content1): self
    {
        $this->content1 = $content1;

        return $this;
    }

    public function getContent2(): ?string
    {
        return $this->content2;
    }

    public function setContent2(string $content2): self
    {
        $this->content2 = $content2;

        return $this;
    }

    public function getContentTable(): ?string
    {
        return $this->contentTable;
    }

    public function setContentTable(?string $contentTable): self
    {
        $this->contentTable = $contentTable;

        return $this;
    }

    public function getCasino(): ?Casino
    {
        return $this->casino;
    }

    public function setCasino(?Casino $casino): self
    {
        if ($casino === null) {
            $this->casino = null;

            return $this;
        }
        // set the owning side of the relation if necessary
        if ($casino->getPage() !== $this) {
            $casino->setPage($this);
        }

        $this->casino = $casino;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->title;
    }

    /**
     * @return bool
     */
    public function isMain(): bool
    {
        return $this->main;
    }

    /**
     * @param bool $main
     */
    public function setMain(bool $main): void
    {
        $this->main = $main;
    }
}
