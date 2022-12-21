<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Problem;

use Floatingbits\EvolutionaryAlgorithmBundle\Entity\Problem;
use Floatingbits\EvolutionaryAlgorithmBundle\Problem\Example\AssignJobToMachinesExample\PersistableProblem;

class ExampleProblemProvider implements PersistableProblemProviderInterface
{
    /**
     * @return Problem[]
     */
    public function getPersistableProblems(): array
    {
        $problem1 = new Problem();
        $problem1->setInstanceClass(PersistableProblem::class);
        $problem1->setDescription('An example problem in which jobs have to be assigned to machines');
        $problem1->setName('Add jobs to machines example');
        return [
            $problem1
        ];
    }


}