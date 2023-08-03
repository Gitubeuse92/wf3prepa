<?php

namespace App\Entity;

use App\Repository\SnippetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SnippetRepository::class)]
class Snippet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $CreatedAt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $EditedAt = null;

    #[ORM\Column]
    private ?bool $IsPublished = false;

    #[ORM\Column]
    private ?bool $IsPublic = false;

    #[ORM\Column]
    private ?bool $IsPRO = false;

    #[ORM\ManyToOne(inversedBy: 'snippets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeInterface $CreatedAt): static
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getEditedAt(): ?\DateTimeInterface
    {
        return $this->EditedAt;
    }

    public function setEditedAt(\DateTimeInterface $EditedAt): static
    {
        $this->EditedAt = $EditedAt;

        return $this;
    }

    public function isIsPublished(): ?bool
    {
        return $this->IsPublished;
    }

    public function setIsPublished(bool $IsPublished): static
    {
        $this->IsPublished = $IsPublished;

        return $this;
    }

    public function isIsPublic(): ?bool
    {
        return $this->IsPublic;
    }

    public function setIsPublic(bool $IsPublic): static
    {
        $this->IsPublic = $IsPublic;

        return $this;
    }

    public function isIsPRO(): ?bool
    {
        return $this->IsPRO;
    }

    public function setIsPRO(?bool $IsPRO): static
    {
        $this->IsPRO = $IsPRO;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
