<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Form\Example\AddJobsToMachinesExample;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('defaultTime', CollectionType::class,
                [
                    'entry_type' => TextType::class,
                    'allow_add' =>true,
                    'prototype' => true
                ])

        ;
    }


}
