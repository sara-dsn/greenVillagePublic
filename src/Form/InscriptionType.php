<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('mail')
            ->add('numero_telephone')
            ->add('adresse')
            ->add('ville')
            ->add('code postal')
            ->add('mot_de_passe')
            ->add('mot_de_passe_confirmation')
            ->add('politiqueDeConfidentialité')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // 'data_class' => Client::class,
        ]);
    }
}
