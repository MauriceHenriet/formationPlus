<?php

namespace App\Controller\API;

use App\Repository\AttestationRepository;
use App\Repository\ConventionRepository;
use App\Repository\EtudiantRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class APIController extends AbstractController
{
    /**
     * @Route("/api/etudiants", name="api_etudiants", methods={"GET"})
     */
    public function getEtudiants(EtudiantRepository $etudiantRepository)
    {
        $etudiants = $etudiantRepository->findAll();
        return $this->json($etudiants, 200, [], ['groups' => 'etudiant:read']);
    }

    /**
     * @Route("/api/conventions", name="api_conventions", methods={"GET"})
     */
    public function getConventions(ConventionRepository $conventionRepository)
    {
        return $this->json($conventionRepository->findAll(), 200, [], ['groups' => 'convention:read']);
    }

    /**
     * @Route("/api/attestations", name="api_attestations", methods={"GET"})
     */
    public function getAttestations(AttestationRepository $attestationRepository)
    {
        return $this->json($attestationRepository->findAll(), 200, [], ['groups' => 'attestation:read']);
    }
}