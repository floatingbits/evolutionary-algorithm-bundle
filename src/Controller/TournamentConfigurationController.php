<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Controller;

use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentConfiguration;
use Floatingbits\EvolutionaryAlgorithmBundle\Form\TournamentConfigurationType;
use Floatingbits\EvolutionaryAlgorithmBundle\Repository\TournamentConfigurationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tournament-configuration')]
class TournamentConfigurationController extends AbstractController
{
    #[Route('/', name: 'evolutionary_algorithm_tournament_configuration_index', methods: ['GET'])]
    public function index(TournamentConfigurationRepository $tournamentConfigurationRepository): Response
    {
        return $this->render('@EvolutionaryAlgorithm/tournament_configuration/index.html.twig', [
            'tournament_configurations' => $tournamentConfigurationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'evolutionary_algorithm_tournament_configuration_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TournamentConfigurationRepository $tournamentConfigurationRepository): Response
    {
        $tournamentConfiguration = new TournamentConfiguration();
        $form = $this->createForm(TournamentConfigurationType::class, $tournamentConfiguration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tournamentConfigurationRepository->save($tournamentConfiguration, true);

            return $this->redirectToRoute('evolutionary_algorithm_tournament_configuration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('@EvolutionaryAlgorithm/tournament_configuration/new.html.twig', [
            'tournament_configuration' => $tournamentConfiguration,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'evolutionary_algorithm_tournament_configuration_show', methods: ['GET'])]
    public function show(TournamentConfiguration $tournamentConfiguration): Response
    {
        return $this->render('@EvolutionaryAlgorithm/tournament_configuration/show.html.twig', [
            'tournament_configuration' => $tournamentConfiguration,
        ]);
    }

    #[Route('/{id}/edit', name: 'evolutionary_algorithm_tournament_configuration_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TournamentConfiguration $tournamentConfiguration, TournamentConfigurationRepository $tournamentConfigurationRepository): Response
    {
        $form = $this->createForm(TournamentConfigurationType::class, $tournamentConfiguration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tournamentConfigurationRepository->save($tournamentConfiguration, true);

            return $this->redirectToRoute('evolutionary_algorithm_tournament_configuration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('@EvolutionaryAlgorithm/tournament_configuration/edit.html.twig', [
            'tournament_configuration' => $tournamentConfiguration,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'evolutionary_algorithm_tournament_configuration_delete', methods: ['POST'])]
    public function delete(Request $request, TournamentConfiguration $tournamentConfiguration, TournamentConfigurationRepository $tournamentConfigurationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tournamentConfiguration->getId(), $request->request->get('_token'))) {
            $tournamentConfigurationRepository->remove($tournamentConfiguration, true);
        }

        return $this->redirectToRoute('evolutionary_algorithm_tournament_configuration_index', [], Response::HTTP_SEE_OTHER);
    }
}
