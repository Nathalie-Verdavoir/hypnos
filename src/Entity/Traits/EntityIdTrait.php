<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * A trait for id property in every entities.
 * You can also use MappedSuperclass but not recommended.
 *
 * @see     https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/inheritance-mapping.html
 * @see     https://medium.com/@galopintitouan/using-traits-to-compose-your-doctrine-entities-9b516335119b
 */
trait EntityIdTrait
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}