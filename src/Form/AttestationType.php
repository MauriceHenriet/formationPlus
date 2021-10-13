<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Convention;
use App\Entity\Attestation;
use App\Repository\EtudiantRepository;
use App\Repository\ConventionRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AttestationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('message', TextareaType::class, [
                'label' => 'Message : '
            ])
            ->add('etudiant', EntityType::class, [
                'label' => 'Etudiant : ',
                'class' => Etudiant::class,
                'placeholder' => 'Choississez un étudiant',
                'query_builder'=>function (EtudiantRepository $er){
                    return $er->createQueryBuilder('e')
                    ->select('e', 'a')
                    ->leftJoin('e.attestation', 'a')
                    ->where('a.id IS NULL');
                },
                'choice_label'=> 'nom'

            ])
            ->add('convention', EntityType::class, [
                'label' => 'Convention : ',
                'empty_data' => 'Choisissez un étudiant',
                'class' => Convention::class,
                'query_builder'=>function (ConventionRepository $cr){
                    return $cr->createQueryBuilder('c')
                    ->select('c', 'e')
                    ->leftJoin('c.etudiant', 'e');
                },
                
                'choice_label'=>'nom'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Attestation::class,
        ]);
    }
}
