<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[ApiResource( 
    collectionOperations: ['get'],
    itemOperations: ['get'],
    routePrefix: '/dates',
    normalizationContext: ['groups' => ['read']],
)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read"])]
    private $id;

    #[ORM\Column(type: 'date')]
    #[Groups(["read"])]
    private $debut;

    #[ORM\Column(type: 'date')]
    #[Groups(["read"])]
    private $fin;

    #[ORM\ManyToOne(targetEntity: Chambres::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private $chambre;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function getChambre(): ?Chambres
    {
        return $this->chambre;
    }

    public function setChambre(?Chambres $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }
}
