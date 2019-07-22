<?php

namespace App\Form;

use App\Entity\Culture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Plants;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Doctrine\ORM\EntityRepository;

class CultureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year', DateType::class, [
            "label" => "Date :",
            "widget" => "single_text",
            "data" => new \DateTime(),
            ])
            ->add('dateSpray', DateType::class, [
                "label" => "Date d'arrosage",
                "widget" => "single_text",
                "data" => new \DateTime(),
            ])
            ->add('period', CheckboxType::class, [
                "label" => "matin ou soir",
            ])
            ->add('pants', EntityType::class, [
                "label" => "Sélectionnez les plantes arrosé",
                'class' => Plants::class,
                'multiple' => true,
            ])
            // ->add('plants', CollectionType::class, [
            //     'entry_type' => Plants::class,
            // ])
            // ->add('photo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Culture::class,
        ]);
    }
}
