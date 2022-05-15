<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('prix')
            ->add('image')
            // ->add('category', ChoiceType::class, [
            //     'choices' => [
            //         new Categorie('Cat1'),
            //         new Categorie('Cat2'),
            //         new Categorie('Cat3'),
            //     ],
            //     'choice_value' => '',
            //     'choice_label' => function(?Categorie $category) {
            //         return $category ? strtoupper($category->getTitre()) : '';
            //     },
            // ]);
            ->add(
                'categorie_id',
                EntityType::class,
                [
                    'class' => Categorie::class,
                    'choice_label' => 'Titre',
                    'expanded' => false,
                    'multiple' => false
                ]
            );
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
