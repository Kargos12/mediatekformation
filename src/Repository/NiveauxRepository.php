<?php

namespace App\Repository;

use App\Entity\Niveaux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Niveaux|null find($id, $lockMode = null, $lockVersion = null)
 * @method Niveaux|null findOneBy(array $criteria, array $orderBy = null)
 * @method Niveaux[]    findAll()
 * @method Niveaux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NiveauxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Niveaux::class);
    }

    // /**
    //  * @return Niveaux[] Returns an array of Niveaux objects
    //  */
   
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    
   /**
    * 
    * @param type $value
    * @return Niveaux|null
    */
    public function findOneBySomeField($value): ?Niveaux
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
     /**
     * Retourne tous les niveaux triées sur un champ
     * @param type $champ
     * @param type $ordre
     * @return Niveaux[]
     */
    public function findAllOrderBy($champ, $ordre): array{
            return $this->createQueryBuilder('n')
                    ->orderBy('n.'.$champ, $ordre)
                    ->getQuery()
                    ->getResult();
    }
     /**
     * Enregistrements dont un champ contient une valeur
     * ou tous les enregistrements si la valeur est vide
     * @param type $champ
     * @param type $valeur
     * @return Niveaux[]
     */
    
    public function findByContainValue($champ, $valeur): array{
        if($valeur==""){
            return $this->createQueryBuilder('n')
                    ->orderBy('n.'.$champ, 'ASC')
                    ->getQuery()
                    ->getResult();
        }else{
            return $this->createQueryBuilder('n')
                    ->where('n.'.$champ.' LIKE :valeur')
                    ->setParameter('valeur', $valeur)
                    ->orderBy('n.nom', 'DESC')
                    ->setParameter('valeur', '%'.$valeur.'%')
                    ->getQuery()
                    ->getResult();            
        }
    }
}
