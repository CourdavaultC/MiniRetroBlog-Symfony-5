<?php

namespace App\Form;

use App\Entity\ConsolesMinis;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsolesMinisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('manufacturer')
            ->add('new_price')
            ->add('used_price')
            ->add('content', CKEditorType::class)
            ->add('slug')
            ->add('manufactured_date')
            ->add('images_consoles_minis', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ConsolesMinis::class,
        ]);
    }
}
