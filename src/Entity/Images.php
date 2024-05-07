<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
class Images
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'images')]
    private Collection $ManyToMany;

    public function __construct()
    {
        $this->ManyToMany = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getManyToMany(): Collection
    {
        return $this->ManyToMany;
    }

    public function addManyToMany(Produit $manyToMany): static
    {
        if (!$this->ManyToMany->contains($manyToMany)) {
            $this->ManyToMany->add($manyToMany);
        }

        return $this;
    }

    public function removeManyToMany(Produit $manyToMany): static
    {
        $this->ManyToMany->removeElement($manyToMany);

        return $this;
    }
    
    public function __toString(): string
    {
        return $this->nom ?? '';
    }
}
