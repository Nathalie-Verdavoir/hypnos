<?php

namespace App\Repository\ModelManagerAdapter;

use Doctrine\ORM\EntityRepository;

/**
 * @see ModelManagerAdapter
 */
interface ModelManagerAdapterInterface
{
    public function getRepository(string $className): EntityRepository;

    public function persist($entity);

    public function remove($entity): void;

    public function flush(): void;

    public function preSave(...$entities): void;

    public function preUpdate(...$entities): void;

    public function save($entity, ?string $notificationKey);

    public function update($entity, ?string $notificationKey);

    public function delete($entity, ?string $notificationKey): void;
}