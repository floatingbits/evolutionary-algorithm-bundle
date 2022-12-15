<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Form\Example\AddJobsToMachinesExample;

use Floatingbits\EvolutionaryAlgorithmBundle\Problem\Example\AssignJobToMachinesExample\PersistableProblem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('jobs', CollectionType::class,
                [
                    'entry_type' => JobType::class,
                    'allow_add' =>true,
                    'prototype' => true
                ])
            ->add('numberOfMachines')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersistableProblem::class,
        ]);
    }


}
