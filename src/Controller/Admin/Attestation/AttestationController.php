<?php

namespace App\Controller\Admin\Attestation;

use App\Form\AttestationType;
use App\Repository\EtudiantRepository;
use App\Repository\ConventionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AttestationController extends AbstractController
{
    /**
     * @Route("/", name="create_attestation")
     */
    public function create(EtudiantRepository $etudiantRepository, 
        Request $request, EntityManagerInterface $em,
        ConventionRepository $cr):Response
    {
        $form = $this->createForm(AttestationType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) // et si attestation n'existe pas
        {
            /** @var Attestation */
            $attestation = $form->getData();

            $em->persist($attestation);
            $em->flush();

            $this->addFlash('success', 'L\'attestation a bien été générée');

        }

        // dd($form->createView());

        return $this->render('admin/attestation/create.html.twig', [
            'formAttestation' => $form->createView()
        ]);
    }

    /**
     * @Route("/get_convention_id/{etudiantId}", name="get_convention_id")
     */
    public function getConventionId(int $etudiantId, EtudiantRepository $er, 
        ConventionRepository $cr)
    {
        $etudiant = $er->find($etudiantId);

        if($etudiant)
        {
            return $this->json(
                [
                    'code'=>200, 
                    'message'=>'success', 
                    'conventionId'=> $etudiant->getConvention()->getId(), 
                    'etudiant' => $etudiant->getNom().' '.$etudiant->getPrenom(),
                    'nbHeur' => $etudiant->getConvention()->getNbHeur()
                ], 200);
        }
        
        return $this->json(['code'=>404, 'message'=>'not found', 'conventionId'=> null ], 404);    
    }
}