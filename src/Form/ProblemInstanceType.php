<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Form;

use Floatingbits\EvolutionaryAlgorithmBundle\Entity\Problem;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\ProblemInstance;
use Floatingbits\EvolutionaryAlgorithmBundle\Problem\PersistableProblemInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProblemInstanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('problem')
        ;
        /** @var ProblemInstance $tournamentRun */
        $problemInstance = $options['data'];
        if ($problemInstance instanceof ProblemInstance &&
            ($problem = $problemInstance->getProblem()) instanceof Problem) {

            $instanceClass = $problem->getInstanceClass();
            try {
                $persistableInstance = new $instanceClass();
                if ($persistableInstance instanceof PersistableProblemInterface) {
                    $formClass = $persistableInstance->getFormClass();
                    $builder->add('persistableProblem', $formClass);
                }
            }
            catch (\Exception $e) {

            }
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProblemInstance::class,
        ]);
    }
}
