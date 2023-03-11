<?php

namespace App\Repository\ModelManagerAdapter;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ModelManagerAdapter extends AbstractController implements ModelManagerAdapterInterface
{

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getRepository(string $className): EntityRepository
    {
        return $this->entityManager->getRepository($className);
    }

    public function persist($entity)
    {
        return $this->entityManager->persist($entity);
    }

    public function remove($entity): void
    {
        $this->entityManager->remove($entity);
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }

    public function preSave(...$entities): void
    {
        foreach ($entities as $entity) {
            $this->addFlash('success', 'L\'entité est sur le point d\'être enregistrée');
            //do what you want on each entity to persist
        }
    }

    public function preUpdate(...$entities): void
    {
        foreach ($entities as $entity) {
            //do what you want on each entity to update
        }
    }

    public function save($entity, ?string $notificationKey)
    {
        $this->preSave($entity);

        $this->persist($entity);
        $this->flush();
        $this->addFlash('success', 'L\'entité' . $notificationKey . ' est enregistrée');
        return $entity;
    }

    public function update($entity, ?string $notificationKey)
    {
        $this->preUpdate($entity);

        $this->update($entity, $notificationKey);
        $this->flush();

        return $entity;
    }

    public function delete($entity, ?string $notificationKey): void
    {
    }
}