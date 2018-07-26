<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\CarnetEntretien;
use App\Form\CarnetEntretienType;
use App\Repository\CarnetEntretienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/carnet/entretien")
 */
class CarnetEntretienController extends Controller {

    /**
     * @Route("/", name="carnet_entretien_index", methods="GET")
     * 
     */
    public function index(Request $request, CarnetEntretienRepository $carnetEntretienRepository, UserInterface $userInterface): Response {
//UserInterface $user
        $userId = $userInterface->getid();
        $request->query->get($userId);

        return $this->render('carnet_entretien/index.html.twig', ['carnet_entretiens' => $carnetEntretienRepository->findAll()]);
        }

        /**
         * @Security("has_role('ROLE_GARAGISTE')")
         * @Route("/new", name="carnet_entretien_new", methods="GET|POST")
         */
        public function new(Request $request): Response
        {
        $carnetEntretien = new CarnetEntretien();
        $form = $this->createForm(CarnetEntretienType::class, $carnetEntretien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($carnetEntretien);
        $em->flush();

        return $this->redirectToRoute('carnet_entretien_index');
        }

        return $this->render('carnet_entretien/new.html.twig', [
                    'carnet_entretien' => $carnetEntretien,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * 
     * @Route("/{id}", name="carnet_entretien_show", methods="GET")
     */
    public function show(CarnetEntretien $carnetEntretien, Request $request, CarnetEntretienRepository $carnetEntretienRepository): Response {
//$uri = $request->getUri();
//print_r($uri);
        $id = $request->query->get('id');

        return $this->render('carnet_entretien/show.html.twig', ['carnet_entretien' => $carnetEntretien]);
    }

    /**
     * @Route("/{id}/edit", name="carnet_entretien_edit", methods="GET|POST")
     */
    public function edit(Request $request, CarnetEntretien $carnetEntretien): Response {


        $form = $this->createForm(CarnetEntretienType::class, $carnetEntretien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carnet_entretien_edit', ['id' => $carnetEntretien->getId()]);
        }

        return $this->render('carnet_entretien/edit.html.twig', [
                    'carnet_entretien' => $carnetEntretien,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carnet_entretien_delete", methods="DELETE")
     */
    public function delete(Request $request, CarnetEntretien $carnetEntretien): Response {
        if ($this->isCsrfTokenValid('delete' . $carnetEntretien->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($carnetEntretien);
            $em->flush();
        }

        return $this->redirectToRoute('carnet_entretien_index');
    }

// UN FONCTION POUR L AJAX 

    /**
     * @Route("/recherche", name="carnet_entretien_recherche", methods="POST")
     */
    public function rechercheAction(Request $request, CarnetEntretien $carnetEntretien, CarnetEntretienRepository $carnetEntretienRepository) {
        if ($request->isXmlHttpRequest()) {
            $mot_cle = $request->request->get('id');
            print_r($mot_cle);
            /*if (!empty($mot_cle)) {
               $resultat = $this->getDoctrine()->getRepository(CarnetEntretienController::class)->find($mot_cle);
            }*/
            return $this->render('carnet_entretien/new.html.twig', array(
                        'villes' => $mot_cle));
        }
    }

}
