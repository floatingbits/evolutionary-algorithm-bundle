<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Controller;

use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentType;
use Floatingbits\EvolutionaryAlgorithmBundle\Form\TournamentTypeType;
use Floatingbits\EvolutionaryAlgorithmBundle\Repository\TournamentTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tournament-type')]
class TournamentTypeController extends AbstractController
{
    #[Route('/', name: 'app_tournament_type_index', methods: ['GET'])]
    public function index(TournamentTypeRepository $tournamentTypeRepository): Response
    {
        return $this->render('@EvolutionaryAlgorithm/tournament_type/index.html.twig', [
            'tournament_types' => $tournamentTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tournament_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TournamentTypeRepository $tournamentTypeRepository): Response
    {
        $tournamentType = new TournamentType();
        $form = $this->createForm(TournamentTypeType::class, $tournamentType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tournamentTypeRepository->save($tournamentType, true);

            return $this->redirectToRoute('app_tournament_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('@EvolutionaryAlgorithm/tournament_type/new.html.twig', [
            'tournament_type' => $tournamentType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tournament_type_show', methods: ['GET'])]
    public function show(TournamentType $tournamentType): Response
    {
        return $this->render('@EvolutionaryAlgorithm/tournament_type/show.html.twig', [
            'tournament_type' => $tournamentType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tournament_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TournamentType $tournamentType, TournamentTypeRepository $tournamentTypeRepository): Response
    {
        $form = $this->createForm(TournamentTypeType::class, $tournamentType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tournamentTypeRepository->save($tournamentType, true);

            return $this->redirectToRoute('app_tournament_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('@EvolutionaryAlgorithm/tournament_type/edit.html.twig', [
            'tournament_type' => $tournamentType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tournament_type_delete', methods: ['POST'])]
    public function delete(Request $request, TournamentType $tournamentType, TournamentTypeRepository $tournamentTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tournamentType->getId(), $request->request->get('_token'))) {
            $tournamentTypeRepository->remove($tournamentType, true);
        }

        return $this->redirectToRoute('app_tournament_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
