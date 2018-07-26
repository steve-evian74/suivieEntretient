<?php

namespace App\Form;

use App\Entity\FicheVoiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FicheVoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('immatriculation')
            ->add('marque')
            ->add('modele')
            ->add('energie')
            ->add('cvFiscale')
            ->add('cvDigne')
            ->add('annee')
            ->add('vente')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FicheVoiture::class,
        ]);
    }
}
