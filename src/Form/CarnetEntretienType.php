<?php

namespace App\Form;

use App\Entity\CarnetEntretien;
use App\Entity\FicheVoiture;
use App\Entity\TypeIntervention;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CarnetEntretienType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('dateIntervention')
                ->add('kilometre')
                ->add('commentaireIntervention')
                ->add('ficheVoiture', EntityType::class, array(
                    'class' => FicheVoiture::class,
                    'choice_label' => 'immatriculation'
                ))
                ->add('typeIntervention', EntityType::class, array(
                    'class' =>TypeIntervention::class,
                    'choice_label' => 'libelle'
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => CarnetEntretien::class,
        ]);
    }

}
