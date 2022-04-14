<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commandes")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_commande;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=LineCommande::class, mappedBy="commande")
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->date_commande;
    }

    public function setDateCommande(\DateTimeInterface $date_commande): self
    {
        $this->date_commande = $date_commande;

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
            $lineCommande->setCommande($this);
        }

        return $this;
    }

    public function removeLineCommande(LineCommande $lineCommande): self
    {
        if ($this->lineCommandes->removeElement($lineCommande)) {
            // set the owning side to null (unless already changed)
            if ($lineCommande->getCommande() === $this) {
                $lineCommande->setCommande(null);
            }
        }

        return $this;
    }
}
