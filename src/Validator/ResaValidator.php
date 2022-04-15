<?php

namespace App\Validator;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use DateInterval;
use DatePeriod;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ResaValidator extends ConstraintValidator
{ 
    /**
    * @var EntityManagerInterface
    */
   private $em;

   /**
    * UserEmailValidator constructor.
    * @param EntityManagerInterface $entityManager
    */
   public function __construct(EntityManagerInterface $entityManager)
   {
       $this->em = $entityManager;

   }
    
    public function validate($value, Constraint $constraint)
    {
        /**  @var ReservationRepository $reservationRepository */
        $reservationRepository = $this->em->getRepository(Reservation::class);
        /** @var $constraint \App\Validator\Resa */

        $values = $this->context->getRoot()->getData();
        $chambre = $values->getChambre();
        $start = $values->getDebut();
        $stop = $values->getFin();

        $interval = DateInterval::createFromDateString('1 day');
        $periodToCheck = new DatePeriod($start, $interval, $stop);
        $reservations = $reservationRepository->findByChambre($chambre);
        $InvalidDates = [];
         foreach ($reservations as $resa) {
            $periodUnavailable = new DatePeriod($resa->getDebut(), $interval, $resa->getFin());
            foreach ($periodToCheck as $dt)
            foreach ($periodUnavailable as $dtu)
                if($dt==$dtu){
                    array_push($InvalidDates,$dt->format('d-M'));
                }
        }
        if(count($InvalidDates)>0) {
            $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ chambre }}', $chambre)
                    ->setParameter('{{ date }}', str_replace(["[","]","-"],' ',json_encode($InvalidDates)) )
                    ->addViolation();
        }
    }
}
