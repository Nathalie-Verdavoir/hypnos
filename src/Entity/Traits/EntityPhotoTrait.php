<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use Doctrine\Common\Collections\Collection;

/**
 * A trait for photo property in every Hotel and Chambre Entities.
 * You can also use MappedSuperclass but not recommended.
 *
 * @see     https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/inheritance-mapping.html
 * @see     https://medium.com/@galopintitouan/using-traits-to-compose-your-doctrine-entities-9b516335119b
 */
trait EntityPhotoTrait
{
    public function getPhoto(): Collection
    {
        return $this->photo;
    }
}