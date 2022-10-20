<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    #[Assert\NotBlank(message: "Le champs {{ label }} ne peut pas être vide")]
    #[Assert\Length(
        min: 1,
        minMessage: "Le champ nom doit faire au minimum {{ limit }} caractères",
        max: 30,
        maxMessage: "Le champ nom ne peut excéder {{ limit }} caractères."
    )]
    private ?string $nom = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message: "Le champs {{ label }} ne peut pas être vide")]
    #[Assert\Length(
        min: 8,
        minMessage: "Le champ téléphone doit avoir au minimum {{ limit }} caractères",
        max: 20,
        maxMessage: "Le champ téléphone doit avoir au maximum {{ limit }} caractères."
    )]
    private ?string $telephone = null;

    #[ORM\Column(length: 70)]
    #[Assert\NotBlank(message: "Le champs {{ label }} ne peut pas être vide")]
    #[Assert\Email(message: 'L\'adresse mail "{{ value }}" n\'est pas valid.')]
    private ?string $mail = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\Positive(message: 'Le nombre de personne doit être plus grand que 0')]
    private ?int $nbre = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $statut = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNbre(): ?int
    {
        return $this->nbre;
    }

    public function setNbre(int $nbre): self
    {
        $this->nbre = $nbre;

        return $this;
    }

    public function getStatut(): ?int
    {
        return $this->statut;
    }

    public function setStatut(int $statut): self
    {
        $this->statut = $statut;

        return $this;
    }
}
