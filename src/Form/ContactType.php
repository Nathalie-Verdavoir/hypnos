<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class, [
            ])
            ->add('prenom',TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('email',EmailType::class, [
                'label' => 'Adresse Email'
            ])
            ->add('objet',ChoiceType::class, [
                'choices'  => [
                    'Selectionnez un objet...' => null,
                    'Je souhaite poser une réclamation' => 'RECLAMATION',
                    'Je souhaite commander un service supplémentaire' => 'SERVICE',
                    'Je souhaite en savoir plus sur une suite' => 'INFOS',
                    'J’ai un souci avec cette application' => 'BUG',
                ],
            ])
            ->add('message', TextareaType::class, [
                'attr' => ['rows' => 6],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}