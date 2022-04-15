<?php

namespace App\Form;

use App\Entity\Hotel;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HotelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('ville')
            ->add('description')
            ->add('adresse')
            ->add('gerant', EntityType::class, [
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                    ->andWhere('u.roles = :val')
                    ->setParameter('val','["ROLE_GERANT"]')
                        ->orderBy('u.id', 'ASC');
                    },
                    'choice_label' => 'nom',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hotel::class,
        ]);
    }
}
