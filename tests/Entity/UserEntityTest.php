<?php

namespace App\Tests\Entity;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserEntityTest extends KernelTestCase
{
    private const NOT_BLANK_MESSAGE = 'Veuillez saisir une valeur';

    private const EMAIL_CONSTRAINT_MESSAGE = "L'email \"BLABLAGMAIL\" n'est pas valide";

    private const INVALID_EMAIL_VALUE = 'BLABLAGMAIL';

    private const PASSWORD_REGEX_CONSTRAINT_MESSAGE = 'Votre mot de passe doit comporter au moins huit caractères, dont des lettres majuscules et minuscules, un chiffre et un symbole.';
   
    private const VALID_EMAIL_VALUE = 'nathalie.verdavoir@laposte.com';

    private const VALID_PASSWORD_VALUE = 'Atchoumdu974!';

    public ValidatorInterface $validator;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->validator = $container->get('validator');
    }

    public function testUserEntityIsValid(): void
    {
        $user = new User();

        $user
            ->setEmail(self::VALID_EMAIL_VALUE)
            ->setPassword(self::VALID_PASSWORD_VALUE);

       $this->getValidatorErrors($user,0);
    }


    public function testUserEntityIsInvalidBecauseNoPassword(): void
    {
        $user = new User();

        $user
            ->setEmail(self::VALID_EMAIL_VALUE);

            $errors = $this->getValidatorErrors($user,1);
            $this->assertEquals(self::NOT_BLANK_MESSAGE, $errors[0]->getMessage());
    }

    
    public function testUserEntityIsInvalidBecauseNoEmail(): void
    {
        $user = new User();

        $user
            ->setPassword(self::VALID_PASSWORD_VALUE);

            $errors = $this->getValidatorErrors($user,1);
            $this->assertEquals(self::NOT_BLANK_MESSAGE, $errors[0]->getMessage());
    }

    
    public function testUserEntityIsInvalidBecauseInvalidEmail(): void
    {
        $user = new User();

        $user
            ->setEmail(self::INVALID_EMAIL_VALUE)
            ->setPassword(self::VALID_PASSWORD_VALUE);

            $errors = $this->getValidatorErrors($user,1);
            $this->assertEquals(self::EMAIL_CONSTRAINT_MESSAGE, $errors[0]->getMessage());
    }

    /**
     * @dataProvider provideInvalidPasswords
     */
    public function testUserEntityIsInvalidBecauseInvalidPassword(string $invalidPassword): void
    {
        $user = new User();

        $user
            ->setEmail(self::VALID_EMAIL_VALUE)
            ->setPassword($invalidPassword);

            $errors = $this->getValidatorErrors($user,1);
            $this->assertEquals(self::PASSWORD_REGEX_CONSTRAINT_MESSAGE, $errors[0]->getMessage());
    }

    public function provideInvalidPasswords(): array{
        return [
            ['Atchoumdu974'], //no special character
            
            ['Atchoumdu!'], //no numbers
            
            ['At74!'], //less than 8 characters
            
            ['atchoumdu974!'], //no uppercase
            
            ['ATCHOUM974!'], //no lowercase
        ];
    }
    private function getValidatorErrors(User $user, int $numberOfExpectedErrors) : ConstraintViolationList
    {
        $errors = $this->validator->validate($user);
        $this->assertCount($numberOfExpectedErrors, $errors);

        return $errors;
    }
}
