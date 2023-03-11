<?php

namespace App\Entity;

use App\Entity\Traits\EntityIdTrait;
use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    use EntityIdTrait;

    #[ORM\Column(type: 'string', length: 255)]
    private $lien;

    #[ORM\Column(type: 'boolean')]
    private $cover;

    #[ORM\ManyToOne(targetEntity: Hotel::class, inversedBy: 'photo')]
    private $hotel;

    #[ORM\ManyToOne(targetEntity: Chambres::class, inversedBy: 'photo')]
    private $chambres;

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }

    public function getCover(): ?bool
    {
        return $this->cover;
    }

    public function setCover(bool $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }

    public function getChambres(): ?Chambres
    {
        return $this->chambres;
    }

    public function setChambres(?Chambres $chambres): self
    {
        $this->chambres = $chambres;

        return $this;
    }
}
