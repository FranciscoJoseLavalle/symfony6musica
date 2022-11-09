<?php

namespace App\Controller;

use App\Entity\Canciones;
use App\Form\CancionesType;
use App\Repository\CancionesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/canciones')]
class CancionesController extends AbstractController
{
    #[Route('/', name: 'app_canciones_index', methods: ['GET'])]
    public function index(CancionesRepository $cancionesRepository): Response
    {
        return $this->render('canciones/index.html.twig', [
            'canciones' => $cancionesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_canciones_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CancionesRepository $cancionesRepository): Response
    {
        $cancione = new Canciones();
        $form = $this->createForm(CancionesType::class, $cancione);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cancionesRepository->save($cancione, true);

            return $this->redirectToRoute('app_canciones_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('canciones/new.html.twig', [
            'cancione' => $cancione,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_canciones_show', methods: ['GET'])]
    public function show(Canciones $cancione): Response
    {
        return $this->render('canciones/show.html.twig', [
            'cancione' => $cancione,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_canciones_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Canciones $cancione, CancionesRepository $cancionesRepository): Response
    {
        $form = $this->createForm(CancionesType::class, $cancione);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cancionesRepository->save($cancione, true);

            return $this->redirectToRoute('app_canciones_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('canciones/edit.html.twig', [
            'cancione' => $cancione,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_canciones_delete', methods: ['POST'])]
    public function delete(Request $request, Canciones $cancione, CancionesRepository $cancionesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cancione->getId(), $request->request->get('_token'))) {
            $cancionesRepository->remove($cancione, true);
        }

        return $this->redirectToRoute('app_canciones_index', [], Response::HTTP_SEE_OTHER);
    }
}
