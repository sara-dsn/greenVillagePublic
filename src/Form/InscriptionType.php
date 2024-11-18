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
            ->add('siret')
            ->add('nom')
            ->add('prenom')
            ->add('mail')
            ->add('numero_telephone')
            ->add('mot_de_passe')
            ->add('mot_de_pass_temporaire')
            ->add('derniere_connexion', null, [
                'widget' => 'single_text',
            ])
            ->add('coeff_vente')
            ->add('reference_client')
            ->add('total_acomptes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
