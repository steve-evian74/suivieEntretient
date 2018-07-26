<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('fullName')
                ->add('username')
                ->add('email', EmailType::class)
                ->add('password', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'first_options' => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password'),
                ))
                ->add('typeRoles', ChoiceType::class, array(
                    'expanded' =>true,
                    'label' => "vous êtes : ",
                    'choices' => array(
                        'particulier' => 1,
                        'garagiste' => 2,
                    ),
                ))
                ->add('nom')
                ->add('prenom')
                ->add('adresse')
                ->add('codePostale')
                ->add('ville')
                ->add('telFixe')
                ->add('telPortable')
                ->add('numeroSiret')
                ->add('description')
                ->add('nomEntreprise')
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

}
