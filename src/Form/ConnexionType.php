<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ConnexionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mail',TextType::class,[
                'attr'=>[
                    'placeholder'=>'  mail',
                    'class'=>'inputFormulaire w-100 my-2'
                ],
                'label'=>false
            ] 
            )
            ->add('mot_de_passe',PasswordType::class,[ 
                'attr'=>[
                    "placeholder"=>"  mot de passe",
                "class"=>"inputFormulaire w-100 my-2"
                ],
                'label'=>false,
            ]) 
            ->add('submit',SubmitType::class,[
                'attr'=>[
                    "class"=>"btn btnFormulaire my-3 ",
                ],
                'label'=>'se connecter'
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
