<?php

namespace App\Repository;

use App\Entity\Photo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Photo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Photo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Photo[]    findAll()
 * @method Photo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Photo::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Photo $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Photo $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return Photo[] Returns an array of Photo objects
     */

    public function findByHotel($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.hotel = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Photo[] Returns an array of Photo objects
     */

    public function findByChambre($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.chambres = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findPhotosAndHotelsAndChambres()
    {
        return $this->createQueryBuilder('p')
            ->addSelect('h')
            ->leftJoin('p.hotel', 'h')
            ->addSelect('c')
            ->leftJoin('p.chambres', 'c')
            ->addSelect('u')
            ->leftJoin('h.gerant', 'u')
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    /*
    public function findOneBySomeField($value): ?Photo
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
