<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Verifier si je suis sur un form edit ou creation
        $builder
            ->add('figures')
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'mb-4'
                ]
            ])
            ->add('link', FileType::class, [
                'mapped' =>false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize'=> '3M',
                        'maxSizeMessage'=>'Désolé mais le fichier {{ name }} de ({{ size }} {{ suffix }}) est trop lourd, la limit est de ({{ limit }} {{ suffix }})',
                        'mimeTypes' => [
                            'image/*'
                         ],
                        'mimeTypesMessage'=> 'Désolé mais ce format ({{ type }}) est pas autorisé'
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
