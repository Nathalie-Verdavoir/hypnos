<?php

namespace App\Tests\Entity;

use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use DateTime;
class ReservationEntityTest extends KernelTestCase
{ 
    private const NOT_BLANK_MESSAGE = 'Veuillez saisir une valeur';
  
    private const EARLIER_DEBUT_CONSTRAINT_MESSAGE = 'Veuillez saisir une date future';

    private const EARLIER_FIN_CONSTRAINT_MESSAGE = 'La date de fin doit être après la date de début';
    
    private const INVALID_EARLIER_DEBUT_VALUE = '1222-12-12';

    private const INVALID_EARLIER_FIN_VALUE = '1222-12-13';

    private const VALID_DEBUT_VALUE = '2222-12-12';

    private const VALID_FIN_VALUE = '2222-12-13';

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->validator = $container->get('validator');
    }

    public function testReservationEntityIsValid(): void
    {
        $reservation = new Reservation();
        $debut = new DateTime(self::VALID_DEBUT_VALUE);
        $fin = new DateTime(self::VALID_FIN_VALUE);
        
        $reservation
            ->setDebut( $debut)
            ->setFin( $fin);

            $this->getValidatorErrors($reservation,0);
    }

    public function testReservationEntityIsInvalidBecauseOfEarlierDebut(): void
    {
        $reservation = new Reservation();
        $debut = new DateTime(self::INVALID_EARLIER_DEBUT_VALUE);
        $fin = new DateTime(self::VALID_FIN_VALUE);
        
        $reservation
            ->setDebut( $debut)
            ->setFin( $fin);

            $errors=$this->getValidatorErrors($reservation,1);
            $this->assertEquals(self::EARLIER_DEBUT_CONSTRAINT_MESSAGE, $errors[0]->getMessage());
    }

    public function testReservationEntityIsInvalidBecauseOfEarlierFin(): void
    {
        $reservation = new Reservation();
        $debut = new DateTime(self::VALID_DEBUT_VALUE);
        $fin = new DateTime(self::INVALID_EARLIER_FIN_VALUE);
        
        $reservation
            ->setDebut( $debut)
            ->setFin( $fin);

            $errors=$this->getValidatorErrors($reservation,1);
            $this->assertEquals(self::EARLIER_FIN_CONSTRAINT_MESSAGE, $errors[0]->getMessage());
    }

    private function getValidatorErrors(Reservation $reservation, int $numberOfExpectedErrors) : ConstraintViolationList
    {
        $errors = $this->validator->validate($reservation);
        $this->assertCount($numberOfExpectedErrors, $errors);

        return $errors;
    }
    
}
