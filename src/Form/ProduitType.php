<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prix')
            ->add('description')
            ->add('quantite')
            ->add('categories', EntityType::class, [
                'label' => 'Categories',
                'class' => Categorie::class,
                'choice_label' => 'nom', // Champ utilisé pour l'affichage des options
                'multiple' => true, // Permettre à l'utilisateur de sélectionner plusieurs catégories
                'expanded' => false, // Afficher le champ comme un select
                'required' => false,
            ])
            ->add('images')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
