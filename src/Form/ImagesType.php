<?php



// src/Form/ImagesType.php

namespace App\Form;

use App\Entity\Images;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ImagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('ManyToMany')
            
            ->add('file', FileType::class, [
                'label' => 'Image',
                'required' => false,
                'mapped' => false, // Ne pas mapper ce champ à une propriété de l'entité
                'attr' => [
                    'accept' => '.jpeg,.png,.jpg', // Types de fichiers acceptés
                ],
                // Contrainte de validation pour vérifier le type MIME du fichier
                'constraints' => [
                    new \Symfony\Component\Validator\Constraints\File([
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/jpg'], // Types MIME acceptés
                        'mimeTypesMessage' => 'Veuillez télécharger une image au format JPEG ou PNG.', // Message d'erreur en cas de type MIME invalide
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Images::class,
        ]);
    }
}
