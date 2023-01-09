<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Controller;

use Floatingbits\EvolutionaryAlgorithmBundle\Entity\ProblemInstance;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentRun;
use Floatingbits\EvolutionaryAlgorithmBundle\Evolution\TournamentRunner;
use Floatingbits\EvolutionaryAlgorithmBundle\Form\TournamentRunType;
use Floatingbits\EvolutionaryAlgorithmBundle\Repository\ProblemInstanceRepository;
use Floatingbits\EvolutionaryAlgorithmBundle\Repository\TournamentRunRepository;
use Floatingbits\EvolutionaryAlgorithmBundle\Theming\TemplateProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tournament-run')]
class TournamentRunController extends AbstractController
{
    #[Route('/', name: 'evolutionary_algorithm_tournament_run_index', methods: ['GET'])]
    public function index(TournamentRunRepository $tournamentRunRepository): Response
    {
        return $this->render('@EvolutionaryAlgorithm/tournament_run/index.html.twig', [
            'tournament_runs' => $tournamentRunRepository->findBy([], ['id' => 'desc']),
        ]);
    }

    #[Route('/new', name: 'evolutionary_algorithm_tournament_run_new', methods: ['GET', 'POST'])]
    public function new(Request $request,
                        TournamentRunRepository $tournamentRunRepository,
                        ProblemInstanceRepository $problemInstanceRepository,
                        TournamentRunner $tournamentRunner): Response
    {
        $tournamentRun = new TournamentRun();

        $form = $this->createForm(TournamentRunType::class, $tournamentRun);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tournamentRunRepository->save($tournamentRun, true);
            $tournamentRunResult = $tournamentRunner->runTournament($tournamentRun);
            /** @todo persist winner specimen collection */
            $tournamentRun->setSerializedSpecimens(serialize($tournamentRunResult->getSpecimenCollection()));
            $tournamentRun->setBestRating($tournamentRunResult->getSpecimenCollection()->getBestMainFitness());
            $tournamentRun->setCumulatedNumRounds($tournamentRunResult->getNumRounds());
            $tournamentRunRepository->save($tournamentRun, true);
            return $this->redirectToRoute('evolutionary_algorithm_tournament_run_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('@EvolutionaryAlgorithm/tournament_run/new.html.twig', [
            'tournament_run' => $tournamentRun,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'evolutionary_algorithm_tournament_run_show', methods: ['GET'])]
    public function show(TournamentRun $tournamentRun, TemplateProvider $templateProvider): Response
    {
        return $this->render('@EvolutionaryAlgorithm/tournament_run/show.html.twig', [
            'tournament_run' => $tournamentRun,
            'template_provider' => $templateProvider
        ]);
    }

    #[Route('/{id}/run', name: 'evolutionary_algorithm_tournament_run_run', methods: ['GET'])]
    public function run(TournamentRun $tournamentRun): Response
    {
        return $this->render('@EvolutionaryAlgorithm/tournament_run/run.html.twig', [
            'tournament_run' => $tournamentRun,
        ]);
    }

    #[Route('/{id}/edit', name: 'evolutionary_algorithm_tournament_run_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TournamentRun $tournamentRun, TournamentRunRepository $tournamentRunRepository): Response
    {
        $form = $this->createForm(TournamentRunType::class, $tournamentRun);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tournamentRunRepository->save($tournamentRun, true);

            return $this->redirectToRoute('evolutionary_algorithm_tournament_run_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('@EvolutionaryAlgorithm/tournament_run/edit.html.twig', [
            'tournament_run' => $tournamentRun,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/rerun', name: 'evolutionary_algorithm_tournament_run_rerun', methods: ['POST'])]
    public function rerun(Request $request,
                          TournamentRun $tournamentRun,
                          TournamentRunRepository $tournamentRunRepository,
                          TournamentRunner $tournamentRunner): Response
    {
        $newRun = new TournamentRun();
        $newRun->setProblemInstance($tournamentRun->getProblemInstance());
        $newRun->setPreviousRun($tournamentRun);
        $newRun->setSerializedSpecimens($tournamentRun->getSerializedSpecimens());
        $newRun->setTournamentConfiguration($tournamentRun->getTournamentConfiguration());

        $tournamentRunRepository->save($newRun, true);
        $tournamentRunResult = $tournamentRunner->runTournament($newRun);
        /** @todo persist winner specimen collection */
        $newRun->setSerializedSpecimens(serialize($tournamentRunResult->getSpecimenCollection()));
        $newRun->setBestRating($tournamentRunResult->getSpecimenCollection()->getBestMainFitness());
        $newRun->setCumulatedNumRounds($tournamentRun->getCumulatedNumRounds() + $tournamentRunResult->getNumRounds());
        $tournamentRunRepository->save($newRun, true);

        return $this->redirectToRoute('evolutionary_algorithm_tournament_run_show', ['id' => $newRun->getId()], Response::HTTP_SEE_OTHER);

    }

    #[Route('/{id}', name: 'evolutionary_algorithm_tournament_run_delete', methods: ['POST'])]
    public function delete(Request $request, TournamentRun $tournamentRun, TournamentRunRepository $tournamentRunRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tournamentRun->getId(), $request->request->get('_token'))) {
            $tournamentRunRepository->remove($tournamentRun, true);
        }

        return $this->redirectToRoute('evolutionary_algorithm_tournament_run_index', [], Response::HTTP_SEE_OTHER);
    }
}
