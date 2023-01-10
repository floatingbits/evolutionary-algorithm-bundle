<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Form;

use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentConfiguration;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentType;
use Floatingbits\EvolutionaryAlgorithmBundle\Evolution\ConfigurableDefaultTournament;
use Floatingbits\EvolutionaryAlgorithmBundle\Evolution\ConfigurableTournamentInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class ConfigurableDefaultTournamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numRounds')
            ->add('cleanupAfterNRounds')
            ->add('numSpecimen')
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConfigurableDefaultTournament::class,
        ]);
    }
}