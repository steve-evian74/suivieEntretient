<?php

namespace App\Controller;

use App\Entity\FicheVoiture;
use App\Form\FicheVoitureType;
use App\Repository\FicheVoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/fiche/voiture")
 */
class FicheVoitureController extends Controller
{
    /**
     * @Route("/", name="fiche_voiture_index", methods="GET")
     */
    public function index(FicheVoitureRepository $ficheVoitureRepository): Response
    {
        return $this->render('fiche_voiture/index.html.twig', ['fiche_voitures' => $ficheVoitureRepository->findAll()]);
    }

    /**
     * @Route("/new", name="fiche_voiture_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $ficheVoiture = new FicheVoiture();
        $form = $this->createForm(FicheVoitureType::class, $ficheVoiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ficheVoiture);
            $em->flush();

            return $this->redirectToRoute('fiche_voiture_index');
        }

        return $this->render('fiche_voiture/new.html.twig', [
            'fiche_voiture' => $ficheVoiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fiche_voiture_show", methods="GET")
     */
    public function show(FicheVoiture $ficheVoiture): Response
    {
        return $this->render('fiche_voiture/show.html.twig', ['fiche_voiture' => $ficheVoiture]);
    }

    /**
     * @Route("/{id}/edit", name="fiche_voiture_edit", methods="GET|POST")
     */
    public function edit(Request $request, FicheVoiture $ficheVoiture): Response
    {
        $form = $this->createForm(FicheVoitureType::class, $ficheVoiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fiche_voiture_edit', ['id' => $ficheVoiture->getId()]);
        }

        return $this->render('fiche_voiture/edit.html.twig', [
            'fiche_voiture' => $ficheVoiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fiche_voiture_delete", methods="DELETE")
     */
    public function delete(Request $request, FicheVoiture $ficheVoiture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ficheVoiture->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ficheVoiture);
            $em->flush();
        }

        return $this->redirectToRoute('fiche_voiture_index');
    }
}
