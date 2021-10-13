<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AttestationRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AttestationRepository::class)
 */
class Attestation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"etudiant:read", "convention:read", "attestation:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"etudiant:read", "convention:read", "attestation:read"})
     */
    private $message;

    /**
     * @ORM\OneToOne(targetEntity=Etudiant::class, inversedBy="attestation", cascade={"persist", "remove"})
     * @Groups("attestation:read")
     */
    private $etudiant;

    /**
     * @ORM\OneToOne(targetEntity=Convention::class, inversedBy="attestation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups("attestation:read")
     */
    private $convention;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getConvention(): ?Convention
    {
        return $this->convention;
    }

    public function setConvention(Convention $convention): self
    {
        $this->convention = $convention;

        return $this;
    }
}
