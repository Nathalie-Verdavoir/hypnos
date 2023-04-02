<?php

namespace App\Entity;

use App\Entity\Traits\EntityIdTrait;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Bad Credentials')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use EntityIdTrait;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Assert\NotBlank(message: 'Veuillez saisir une valeur')]
    #[Assert\Email(message: 'L\'email {{ value }} n\'est pas valide')]
    private ?string $email;

    #[ORM\Column(type: 'json', length: 180)]
    private array $roles = [];

    #[ORM\Column(type: 'string')]
    #[Assert\Regex(pattern: '/^(?=.*\d)(?=.*[A-Z])(?=.*[!#$%&*+\/=?^_`{|}~-])(?!.*(.)\1{2}).*[a-z].{8,}$/m', message: 'Votre mot de passe doit comporter au moins huit caractères, dont des lettres majuscules et minuscules, un chiffre et un symbole.')]
    private string $password;

    #[ORM\Column(type: 'string', length: 40)]
    private ?string $nom;

    #[ORM\Column(type: 'string', length: 40)]
    private ?string $prenom;
    private ?string $prenom_bis;

    #[ORM\OneToOne(inversedBy: 'gerant', targetEntity: Hotel::class, cascade: ['persist', 'remove'])]
    private ?Hotel $hotel;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Reservation::class, orphanRemoval: true)]
    private $reservations;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isActive;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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
            $reservation->setClient($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getClient() === $this) {
                $reservation->setClient(null);
            }
        }

        return $this;
    }

    public function isDeleted(): bool
    {
        if (!$this->isActive) {
            return true;
        }
        return false;
    }

    public function __toString()
    {
        return $this->prenom . ' ' . $this->nom;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive = true): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrenomBis(): ?string
    {
        return $this->prenom;
    }

    /**
     * @param string|null $prenom_bis
     */
    public function setPrenomBis(?string $prenom_bis): void
    {
        $this->setPrenom($prenom_bis);
        $this->prenom_bis = $prenom_bis;
    }
}
