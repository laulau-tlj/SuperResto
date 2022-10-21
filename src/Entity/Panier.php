<?php

namespace App\Entity;

use App\Entity\Utilisateurs;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PanierRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'panier', targetEntity: menu::class, orphanRemoval: true)]
    private Collection $menu;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateurs $utilisateur = null;

    public function __construct()
    {
        $this->menu = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, menu>
     */
    public function getMenu(): Collection
    {
        return $this->menu;
    }

    public function addMenu(menu $menu): self
    {
        if (!$this->menu->contains($menu)) {
            $this->menu->add($menu);
            $menu->setPanier($this);
        }

        return $this;
    }

    public function removeMenu(menu $menu): self
    {
        if ($this->menu->removeElement($menu)) {
            // set the owning side to null (unless already changed)
            if ($menu->getPanier() === $this) {
                $menu->setPanier(null);
            }
        }

        return $this;
    }

    public function getUtilisateur(): ?Utilisateurs
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(Utilisateurs $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
