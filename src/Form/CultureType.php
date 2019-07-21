<?php

namespace App\Form;

use App\Entity\Culture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Plants;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Doctrine\ORM\EntityRepository;

class CultureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year')
            ->add('dateSpray')
            ->add('period')
            ->add('pants', CollectionType::class, [
                'class' => Plants::class,
                "query_builder" => function(EntityRepository $entityRepository){
                    $queryBuilder = $entityRepository->createQueryBuilder('plant');
                    $queryBuilder->addOrderBy("plant.name", "ASC");
                },
            ])
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
