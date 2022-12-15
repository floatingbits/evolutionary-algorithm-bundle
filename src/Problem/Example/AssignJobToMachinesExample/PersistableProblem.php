<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Problem\Example\AssignJobToMachinesExample;

use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem\AbstractProblem;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem\Job;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\ProblemInstance;
use Floatingbits\EvolutionaryAlgorithmBundle\Form\Example\AddJobsToMachinesExample\ConfigureType;
use Floatingbits\EvolutionaryAlgorithmBundle\Problem\PersistableProblemInterface;

class PersistableProblem extends AbstractProblem implements PersistableProblemInterface
{



    /** @var Job[] */
    private $jobs;

    /** @var int */
    private $numberOfMachines;


    /**
     * @param Job[] $jobs
     * @return void
     */
    public function setJobs(array $jobs): void {
        $this->jobs = $jobs;
    }

    /**
     * @param Job $job
     * @return void
     */
    public function addJob(Job $job) {
        $jobs = $this->getJobs();
        $jobs[] = $job;
        $this->setJobs($jobs);
    }



    /**
     * @return Job[]
     */
    public function getJobs(): array
    {
        return $this->jobs;
    }


    /**
     * @return string
     */
    public function getFormClass(): string
    {
        return ConfigureType::class;
    }

    /**
     * @return string
     */
    public function getFormTemplate(): string
    {
        return '@EvolutionaryAlgorithm/problem_instance/example/add_jobs_to_machines_example/_form.html.twig';
    }

    /**
     * @return int
     */
    public function getNumberOfMachines(): int
    {
        return $this->numberOfMachines;
    }

    /**
     * @param int $numberOfMachines
     */
    public function setNumberOfMachines(int $numberOfMachines): void
    {
        $this->numberOfMachines = $numberOfMachines;
    }



}