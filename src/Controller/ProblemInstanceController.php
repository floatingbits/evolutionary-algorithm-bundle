<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\ProblemInstance;
use Floatingbits\EvolutionaryAlgorithmBundle\Form\ProblemInstanceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/problem-instance')]
class ProblemInstanceController extends AbstractController
{
    #[Route('/', name: 'evolutionary_algorithm_problem_instance_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $problemInstances = $entityManager
            ->getRepository(ProblemInstance::class)
            ->findAll();

        return $this->render('@EvolutionaryAlgorithm/problem_instance/index.html.twig', [
            'problem_instances' => $problemInstances,
        ]);
    }

    #[Route('/new', name: 'evolutionary_algorithm_problem_instance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $problemInstance = new ProblemInstance();
        $form = $this->createForm(ProblemInstanceType::class, $problemInstance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($problemInstance);
            $entityManager->flush();

            return $this->redirectToRoute('evolutionary_algorithm_problem_instance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('@EvolutionaryAlgorithm/problem_instance/new.html.twig', [
            'problem_instance' => $problemInstance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'evolutionary_algorithm_problem_instance_show', methods: ['GET'])]
    public function show(ProblemInstance $problemInstance): Response
    {
        return $this->render('@EvolutionaryAlgorithm/problem_instance/show.html.twig', [
            'problem_instance' => $problemInstance,
        ]);
    }

    #[Route('/{id}/edit', name: 'evolutionary_algorithm_problem_instance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProblemInstance $problemInstance, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProblemInstanceType::class, $problemInstance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('evolutionary_algorithm_problem_instance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('@EvolutionaryAlgorithm/problem_instance/edit.html.twig', [
            'problem_instance' => $problemInstance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'evolutionary_algorithm_problem_instance_delete', methods: ['POST'])]
    public function delete(Request $request, ProblemInstance $problemInstance, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$problemInstance->getId(), $request->request->get('_token'))) {
            $entityManager->remove($problemInstance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('evolutionary_algorithm_problem_instance_index', [], Response::HTTP_SEE_OTHER);
    }
}
