<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\FicheVoiture;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/")
 */
class UserController extends Controller {

    /**
     * @Route("/", name="pageDefault", methods="GET")
     */
    public function pageDefault() {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/user", name="user_index", methods="GET")
     */
    public function index(UserRepository $userRepository): Response {


        return $this->render('user/index.html.twig', ['users' => $userRepository->findAll()]);

        }

        /**
         * @Route("/user/new", name="user_new", methods="GET|POST")
         */
        public function new(Request $request): Response
        {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
                    'user' => $user,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/{id}", name="user_show",requirements={"id" = "\d+"}, methods="GET", defaults={"id" = 1})
     */
    public function show(Request $request, UserInterface $userInterface, User $user, $id): Response {

        //UserInterface $user
        $userId = $userInterface->getid();
        print_r($userId);
        $request->query->get($userId);

        return $this->render('user/show.html.twig', ['user' => $user]);
        // return $this->generateUrl('user_show', array('id'=>$userId));
    }

    /**
     * @Route("/user/{id}/edit", name="user_edit", methods="GET|POST")
     */
    public function edit(Request $request, User $user): Response {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', ['id' => $user->getId()]);
        }

        return $this->render('user/edit.html.twig', [
                    'user' => $user,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/{id}", name="user_delete", methods="DELETE")
     */
    public function delete(Request $request, User $user): Response {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * @Route("/user/info/{id}", name="user_show_info",requirements={"id" = "\d+"}, methods="GET")
     *  @Security("has_role('ROLE_PARTICULIER')")
     */
    public function infoPerso(Request $request, UserInterface $userInterface, User $user, $id): Response {

        //UserInterface $user
        $userId = $userInterface->getid();
        print_r($userId);
        $request->query->get($userId);
        if ($request->get('id') == $userId) {
            return $this->render('user/info.html.twig', ['users' => $user]);
            //return $this->redirectToRoute('user_show_info', ['id'=>$user->getId()]);
        }
        else
        {
             return $this->redirectToRoute('pageDefault');
        }
    }

}
