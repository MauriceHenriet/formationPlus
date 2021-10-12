<?php

namespace App\Entity;

use App\Repository\ConventionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConventionRepository::class)
 */
class Convention
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbHeur;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="convention")
     */
    private $etudiant;

    /**
     * @ORM\OneToOne(targetEntity=Attestation::class, mappedBy="convention", cascade={"persist", "remove"})
     */
    private $attestation;

    public function __construct()
    {
        $this->etudiant = new ArrayCollection();
    }

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

    public function getNbHeur(): ?int
    {
        return $this->nbHeur;
    }

    public function setNbHeur(int $nbHeur): self
    {
        $this->nbHeur = $nbHeur;

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiant(): Collection
    {
        return $this->etudiant;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiant->contains($etudiant)) {
            $this->etudiant[] = $etudiant;
            $etudiant->setConvention($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiant->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getConvention() === $this) {
                $etudiant->setConvention(null);
            }
        }

        return $this;
    }

    public function getAttestation(): ?Attestation
    {
        return $this->attestation;
    }

    public function setAttestation(Attestation $attestation): self
    {
        // set the owning side of the relation if necessary
        if ($attestation->getConvention() !== $this) {
            $attestation->setConvention($this);
        }

        $this->attestation = $attestation;

        return $this;
    }
}
