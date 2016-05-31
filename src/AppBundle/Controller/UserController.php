<?php
/**
 * Created by PhpStorm.
 * User: KevinSup
 * Date: 28/05/2016
 * Time: 17:27
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\UserTypeRegistration;


class UserController extends Controller
{
    public function registrerAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(UserTypeRegistration::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setSalt('');
            $user->setRoles(array('ROLE_USER'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_login');
        }

        return $this->render('AppBundle:User:registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('AppBundle:User:login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }

    public function accountAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if (!$user) {
            return $this->redirectToRoute('user_login');
        }

        return $this->render('AppBundle:User:account.html.twig', [
            'user' => $user
        ]);
    }
}