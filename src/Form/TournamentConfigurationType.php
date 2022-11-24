<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Form;

use Floatingbits\EvolutionaryAlgorithmBundle\Entity\Problem;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\ProblemInstance;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentConfiguration;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentType;
use Floatingbits\EvolutionaryAlgorithmBundle\Evolution\ConfigurableTournamentInterface;
use Floatingbits\EvolutionaryAlgorithmBundle\Problem\PersistableProblemInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TournamentConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tournamentType')
        ;
        $tournamentConfiguration = $options['data'];
        if ($tournamentConfiguration instanceof TournamentConfiguration &&
            ($tournamentType = $tournamentConfiguration->getTournamentType()) instanceof TournamentType) {

            $instanceClass = $tournamentType->getInstanceClass();
            try {
                $persistableInstance = new $instanceClass();
                if ($persistableInstance instanceof ConfigurableTournamentInterface) {
                    $formClass = $persistableInstance->getFormClass();
                    $builder->add('configurableTournament', $formClass);
                }
            }
            catch (\Exception $e) {

            }
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TournamentConfiguration::class,
        ]);
    }
}
