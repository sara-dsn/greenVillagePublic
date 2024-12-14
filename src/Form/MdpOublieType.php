<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MdpOublieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mail',EmailType::class,[
                "label"=>false,
                'attr'=>[
                    "placeholder"=>"mail",
                    "class"=>"inputFormulaire w-100 "
                ]
            ])
            ->add('submit', SubmitType::class,[
                "label"=>"changer de mot de passe",
                "attr"=>[
                    "class"=>"btnFormulaire  "
                ]
            ])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
  