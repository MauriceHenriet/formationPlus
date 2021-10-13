<?php

namespace App\Repository;

use App\Entity\Etudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }

//SELECT * FROM etudiant LEFT OUTER JOIN attestation ON attestation.etudiant_id = etudiant.id WHERE attestation.id IS NULL;


public function findEtudiantsByNoAttestation()
{
        return $this->createQueryBuilder('e')
        ->select('e', 'a')
        ->leftJoin('e.attestation', 'a')
        ->where('a.id IS NULL')
        ->getQuery()
        ->getResult()
        ;

        // $db = $this->getEntityManager()->getConnection();
        // $query = $db->prepare("SELECT * FROM etudiant LEFT OUTER JOIN attestation ON attestation.etudiant_id = etudiant.id WHERE attestation.id IS NULL");
        // return $query->executeQuery()->fetchAllAssociative();
        

    }

    // /**
    //  * @return Etudiant[] Returns an array of Etudiant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Etudiant
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
