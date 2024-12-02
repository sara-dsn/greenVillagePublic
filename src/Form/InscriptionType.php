<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'  nom',
                    'class'=>'w-100 my-2 inputFormulaire'
                ]
            ])
            ->add('prenom', TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'  prénom',
                    'class'=>'w-100 my-2 inputFormulaire'
                ]
            ])
            ->add('mail', EmailType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'  mail',
                    'class'=>'w-100 my-2 inputFormulaire'
                ]
            ])
            ->add('numeroTelephone',TelType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'  numéro de téléphone',
                    'class'=>'w-100 my-2 inputFormulaire'
                ]
            ])
            ->add('adresse',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'  adresse',
                    'class'=>'w-100 my-2 inputFormulaire'
                ]
            ])
            ->add('ville',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'  ville',
                    'class'=>'w-100 my-2 inputFormulaire'
                ]
            ])
            ->add('cp',NumberType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'  code postal',
                    'class'=>'w-100 my-2 inputFormulaire'
                ]
            ])
            ->add('mdp', PasswordType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'  mot de passe',
                    'class'=>'w-100 my-2 inputFormulaire'
                ]
            ])
            ->add('mdp_confirmation', PasswordType::class,[
            'label'=>false,
            'attr'=>[
                'class'=>'w-100 my-2 inputFormulaire',
                'placeholder'=>'  mot de passe confirmation'
                ]

            ])
            ->add('radio', RadioType::class,[
            'label'=>false,
            'attr'=>[
                'class'=>'form-check-input radio',
                'type'=>'radio'
            ] 
            ])
            ->add('submit',SubmitType::class,[
                'label'=>'enregistrer',
                'attr'=>[
                    'class'=>' btn btnFormulaire  mb-4'
                ]
            ])

        ;
        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $AvantEnvoi){
            $form=$AvantEnvoi->getForm();
            $data=$form->getData();

            if($data['mdp']!==$data['mdp_confirmation']){
                $form->get('mdp_confirmation')->addError(new FormError('Les deux mots de passe doivent être identiques.'));
            };

        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // 'data_class' => Client::class,
        ]);
    }
}
