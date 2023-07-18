<?php

namespace App\Repository;

use App\Entity\Hotel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Hotel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hotel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hotel[]    findAll()
 * @method Hotel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hotel::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Hotel $entity, bool $flush = true): void
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
    public function remove(Hotel $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Hotel[] Returns an array of Hotel objects
    //  */
    public function findAllHotelsAndPics()
    {
        return $this->createQueryBuilder('h')
            ->addSelect('p')
            ->leftJoin('h.photo', 'p')
            ->addSelect('g')
            ->leftJoin('h.gerant', 'g')
            ->orderBy('h.id', 'ASC')
            ->getQuery()
            ->getResult();
    }


    public function findHotelAndPics($value): ?Hotel
    {
        return $this->createQueryBuilder('h')
            ->addSelect('c')
            ->leftJoin('h.chambres', 'c')
            ->addSelect('ph')
            ->leftJoin('c.photo', 'ph')
            ->addSelect('p')
            ->leftJoin('h.photo', 'p')
            ->addSelect('g')
            ->leftJoin('h.gerant', 'g')
            ->andWhere('h.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

}
