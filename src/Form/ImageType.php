<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\user;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ImageType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
                ->add('image', FileType::class, array('label' => 'Ajouter l\'image'))
                ->add('user', EntityType::class, array(
                'class'=> User::class,
                'choice_label'=> 'prenom'
            ));
    }

    /*public function recupSessionID() {
        UserInterface $user
        $userId = $userInterface->getid();
        print_r($userId);
        $request->query->get($userId);
        
        
    }*/

    public
            function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Image::class,
        ));
    }

}
