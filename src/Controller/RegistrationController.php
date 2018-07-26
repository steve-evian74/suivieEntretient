<?php

// src/Controller/RegistrationController.php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller {

    /**
     * @Route("/inscription", name="user_registration")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder) {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        // 'Particulier' => 'ROLE_ADMIN',
        // 'Garagiste' => 'ROLE_USER',
        $typerRole = $form->get('typeRoles')->getData();
        //exit;
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            // Par defaut l'utilisateur aura toujours le rôle ROLE_USER
            if ($typerRole == 1) {
                $user->setRoles(['ROLE_PARTICULIER']);
            } elseif ($typerRole == 2) {
                $user->setRoles(['ROLE_GARAGISTE']);
            }

            // On enregistre l'utilisateur dans la base
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

           return $this->redirectToRoute('security_login');
            /*if ($typerRole == 1) {
                return $this->redirectToRoute('user_show',['id'=>$user->getId()]);
            } elseif ($typerRole == 2) {
                return $this->render('garagiste/index.html.twig');
            }*/
        }

        return $this->render(
                        'register.html.twig', array('form' => $form->createView())
        );
    }

}
