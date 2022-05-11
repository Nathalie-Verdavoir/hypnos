<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\ReservationRepository;
use Symfony\Component\Validator\Constraints as Assert;
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
    #[Assert\NotBlank(message:'Veuillez saisir une valeur')]
    #[Assert\DateTimeInterface(message:'Veuillez saisir une date')]
    #[Assert\GreaterThan("today",message:'Veuillez saisir une date future')]
    private $debut;

    #[ORM\Column(type: 'date')]
    #[Groups(["read"])]
    #[Assert\NotBlank(message:'Veuillez saisir une valeur')]
    #[Assert\Expression( "this.getFin() >= this.getDebut()", message:"La date de fin doit être après la date de début")]
    private $fin;

    #[ORM\ManyToOne(targetEntity: Chambres::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["read"])]
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

    public function getFin(): ?\DateTime
    {
        return $this->fin;
    }

    public function setFin(?\DateTime $fin): self
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
