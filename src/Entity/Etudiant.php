<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EtudiantRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"etudiant:read", "convention:read", "attestation:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"etudiant:read", "convention:read", "attestation:read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"etudiant:read", "convention:read", "attestation:read"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"etudiant:read", "convention:read", "attestation:read"})
     */
    private $mail;

    /**
     * @ORM\ManyToOne(targetEntity=Convention::class, inversedBy="etudiant")
     * @Groups("etudiant:read")
     */
    private $convention;

    /**
     * @ORM\OneToOne(targetEntity=Attestation::class, mappedBy="etudiant", cascade={"persist", "remove"})
     * @Groups("etudiant:read")
     */
    private $attestation;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getConvention(): ?Convention
    {
        return $this->convention;
    }

    public function setConvention(?Convention $convention): self
    {
        $this->convention = $convention;

        return $this;
    }

    public function getAttestation(): ?Attestation
    {
        return $this->attestation;
    }

    public function setAttestation(?Attestation $attestation): self
    {
        // unset the owning side of the relation if necessary
        if ($attestation === null && $this->attestation !== null) {
            $this->attestation->setEtudiant(null);
        }

        // set the owning side of the relation if necessary
        if ($attestation !== null && $attestation->getEtudiant() !== $this) {
            $attestation->setEtudiant($this);
        }

        $this->attestation = $attestation;

        return $this;
    }
}
