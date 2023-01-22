<?php

namespace App\Form;

use App\Entity\Chambres;
use App\Entity\Reservation;
use App\Validator\Resa;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('debut', DateType::class, [
                'attr' => ['class' => 'd-none'],
                'label_attr' => ['class' => 'd-none'],
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('fin', DateType::class, [
                'attr' => ['class' => 'd-none'],
                'label_attr' => ['class' => 'd-none'],
                'constraints' => [
                    new NotBlank(),
                    new Resa(),
                ],
            ])
            ->add('chambre', EntityType::class, [
                'class' => Chambres::class,
                'attr' => ['class' => 'd-none'],
                'label_attr' => ['class' => 'd-none'],
                'constraints' => [
                    new NotBlank()
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
