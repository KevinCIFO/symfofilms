<?php

namespace App\Form;

use App\Entity\Actor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Repository\ActorRepository;

use App\Form\Custom\DataListType;

class PeliculaAddActorFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('actor', DataListType::class, [
                'class' => Actor::class,
                'choice_label' => 'nombre',
                'label' => 'Añadir actor',
                'query_builder' => function (ActorRepository $er) {
                    return $er->createQueryBuilder('a')
                    ->orderBy('a.nombre', 'ASC');
                }
            ])
            ->add('Add', SubmitType::class, [
                'label' => 'Añadir',
                'attr' => ['class' => 'btn btn-success my-3']
            ])
            ->setAction($options['action'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NULL,
        ]);
    }
}
