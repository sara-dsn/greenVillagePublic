<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ConnexionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
    
            ->add('mail',TextType::class,[
                'attr'=>[
                    'name' => 'mail', // Symfony veut _username

                    'placeholder'=>'  mail',
                    'class'=>'inputFormulaire w-100 my-2'
                ],
                'label'=>false
            ] 
            )
            ->add('password',PasswordType::class,[ 
                'attr'=>[
                    'name' => 'password', // Symfony veut _password

                    "placeholder"=>"  mot de passe",
                "class"=>"inputFormulaire w-100 my-2"
                ],
                'label'=>false,
            ]) 
            ->add('submit',SubmitType::class,[
                'attr'=>[
                    "class"=>"btn btnFormulaire my-3 ",
                    // "href"=>"app_accueil",
                ],
                'label'=>'se connecter'
            ])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // 'data_class' => Client::class,
        ]);
    }
}
