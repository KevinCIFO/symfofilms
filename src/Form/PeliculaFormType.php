<?php

namespace App\Form;

use App\Entity\Pelicula;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Validator\Constraints\File;

class PeliculaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo', TextType::class, array('label' => 'Título'))
            ->add('estreno', NumberType::class, [
                'label' => 'Año',
                'html5' => true
            ])
            ->add('duracion', NumberType::class, [
                'empty_data' => 0,
                'label' => 'Duración',
                'html5' => true
            ])
            ->add('sinopsis', TextareaType::class, ['attr' => ['style' => 'height: 100px']])
            ->add('director')
            ->add('genero', TextType::class, array('label' => 'Género'))
            ->add('valoracion', NumberType::class, [
                'label' => 'Valoración',
                'required' => false,
                'html5' => true
            ])
            ->add('imagen', FileType::class, [
                'required' => false,
                'data_class' => NULL,
                'constraints' => [
                    new File([
                        'maxSize' => '10240k',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'], 
                        'mimeTypesMessage' => 'Debes subir una imagen png, jpg o gif'
                    ])
                ]
                    ])
            ->add('Guardar', SubmitType::class, ['attr' => ['class' => 'btn btn-success my-3']]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pelicula::class,
        ]);
    }
}
