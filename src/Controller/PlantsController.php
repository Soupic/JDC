<?php

namespace App\Controller;

use App\Entity\Plants;
use App\Form\PlantsType;
use App\Repository\PlantsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/plants")
 */
class PlantsController extends AbstractController
{
    /**
     * @Route("/", name="plants_index", methods={"GET"})
     */
    public function index(PlantsRepository $plantsRepository): Response
    {
        return $this->render('plants/index.html.twig', [
            'plants' => $plantsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="plants_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $plant = new Plants();
        $form = $this->createForm(PlantsType::class, $plant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plant);
            $entityManager->flush();

            return $this->redirectToRoute('plants_index');
        }

        return $this->render('plants/new.html.twig', [
            'plant' => $plant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plants_show", methods={"GET"})
     */
    public function show(Plants $plant): Response
    {
        return $this->render('plants/show.html.twig', [
            'plant' => $plant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="plants_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Plants $plant): Response
    {
        $form = $this->createForm(PlantsType::class, $plant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plants_index');
        }

        return $this->render('plants/edit.html.twig', [
            'plant' => $plant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plants_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Plants $plant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($plant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('plants_index');
    }
}
