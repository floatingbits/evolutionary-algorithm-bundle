<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Problem\Example\AssignJobToMachinesExample;

use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem\AbstractProblem;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem\Job;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\ProblemInstance;
use Floatingbits\EvolutionaryAlgorithmBundle\Form\Example\AddJobsToMachinesExample\ConfigureType;
use Floatingbits\EvolutionaryAlgorithmBundle\Problem\PersistableProblemInterface;

class PersistableProblem extends AbstractProblem implements PersistableProblemInterface
{

    /** @var ProblemInstance */
    private $problemInstanceEntity;

    /**
     * @return ProblemInstance
     */
    public function getProblemInstanceEntity(): ProblemInstance
    {
        return $this->problemInstanceEntity;
    }

    /**
     * @param ProblemInstance $problemInstanceEntity
     */
    public function setProblemInstanceEntity(ProblemInstance $problemInstanceEntity): void
    {
        $this->problemInstanceEntity = $problemInstanceEntity;
    }

    /**
     * @param Job[] $jobs
     * @return void
     */
    public function setJobs(array $jobs): void {
        $this->problemInstanceEntity->setSerializedInstance($this->convertFromJobs($jobs));
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
     * @param Job[] $jobs
     * @return string
     */
    private function convertFromJobs(array $jobs): string {
        return serialize($jobs);
    }

    /**
     * @param ProblemInstance $problemInstanceEntity
     * @return Job[]
     */
    private function convertToJobs(ProblemInstance $problemInstanceEntity): array {
            return unserialize($problemInstanceEntity->getSerializedInstance());
    }

    /**
     * @return Job[]
     */
    public function getJobs(): array
    {
        return $this->convertToJobs($this->problemInstanceEntity);
    }


    /**
     * @return string
     */
    public function getFormClass(): string
    {
        return ConfigureType::class;
    }

    /**
     * @todo implement properly
     * @return int
     */
    public function getNumberOfMachines(): int {
        return 5;
    }

}