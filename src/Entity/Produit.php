<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="produits")
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prix;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=LineCommande::class, mappedBy="produit")
     */
    private $lineCommandes;

    public function __construct()
    {
        $this->lineCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
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

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, LineCommande>
     */
    public function getLineCommandes(): Collection
    {
        return $this->lineCommandes;
    }

    public function addLineCommande(LineCommande $lineCommande): self
    {
        if (!$this->lineCommandes->contains($lineCommande)) {
            $this->lineCommandes[] = $lineCommande;
            $lineCommande->setProduit($this);
        }

        return $this;
    }

    public function removeLineCommande(LineCommande $lineCommande): self
    {
        if ($this->lineCommandes->removeElement($lineCommande)) {
            // set the owning side to null (unless already changed)
            if ($lineCommande->getProduit() === $this) {
                $lineCommande->setProduit(null);
            }
        }

        return $this;
    }
}
