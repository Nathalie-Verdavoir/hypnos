<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Traits\EntityPhotoTrait;
use App\Repository\ChambresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get'],
    routePrefix: '/dates',
    normalizationContext: ['groups' => ['read'], "enable_max_depth" => true],
)]
#[ORM\Entity(repositoryClass: ChambresRepository::class)]
class Chambres
{
    use EntityPhotoTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Groups(["read"])]
    private $prix;

    #[ORM\ManyToOne(targetEntity: Hotel::class, inversedBy: 'chambres', fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: false)]
    private $hotel;

    #[ORM\OneToMany(mappedBy: 'chambres', targetEntity: Photo::class, fetch: 'EAGER')]
    private $photo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $booking;

    #[ORM\OneToMany(mappedBy: 'chambre', targetEntity: Reservation::class, orphanRemoval: true, fetch: 'EAGER')]
    #[Groups(["read"])]
    private $reservations;

    public function __construct()
    {
        $this->photo = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

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

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photo->contains($photo)) {
            $this->photo[] = $photo;
            $photo->setChambres($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photo->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getChambres() === $this) {
                $photo->setChambres(null);
            }
        }

        return $this;
    }

    public function getBooking(): ?string
    {
        return $this->booking;
    }

    public function setBooking(?string $booking): self
    {
        $this->booking = $booking;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setChambre($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getChambre() === $this) {
                $reservation->setChambre(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->titre;
    }
}
