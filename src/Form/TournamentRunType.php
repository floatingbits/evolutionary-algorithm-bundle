<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Form;

use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentRun;
use Floatingbits\EvolutionaryAlgorithmBundle\Problem\PersistableProblemInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TournamentRunType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tournamentConfiguration')
            ->add('problemInstance')
        ;
//        /** @var TournamentRun $tournamentRun */
//        $tournamentRun = $options['data'];
//        if ($problemInstance = $tournamentRun->getProblemInstance()) {
//            $problem = $problemInstance->getProblem();
//            $instanceClass = $problem->getInstanceClass();
//
//            try {
//                $persistableInstance = new $instanceClass();
//                if ($persistableInstance instanceof PersistableProblemInterface) {
//                    $formClass = $persistableInstance->getFormClass();
//                    $builder->add('persistableProblem', $formClass);
//                }
//
//            }
//            catch (\Exception $e) {
//
//            }
//        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TournamentRun::class,
        ]);
    }
}
