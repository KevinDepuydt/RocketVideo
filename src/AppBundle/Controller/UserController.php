<?php
/**
 * Created by PhpStorm.
 * User: KevinSup
 * Date: 28/05/2016
 * Time: 17:27
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Watchlist;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\UserTypeUpdate;
use AppBundle\Form\Type\UserTypePasswordUpdate;
use AppBundle\Form\Type\UserTypeRegistration;


class UserController extends Controller
{
    public function registrerAction(Request $request)
    {
        $user = new User();
        $watchlist = new Watchlist();

        $form = $this->createForm(UserTypeRegistration::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            
            $encoder = $this->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($encoded);
            $user->setSalt('');
            $user->setRoles(array('ROLE_USER'));
            $user->setWatchlist($watchlist);

            $em->persist($watchlist);
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

    public function accountAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $encoder = $this->get('security.password_encoder');

        if (!$user) {
            return $this->redirectToRoute('user_login');
        }

        $form_info = $this->createForm(UserTypeUpdate::class, $user);
        $form_info->handleRequest($request);
        $response_info = null;

        if ($form_info->isSubmitted() && $form_info->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $response_info = [
                'success' => true,
                'message' => 'Vos informations ont été mises à jour'
            ];
        }

        $user_password = new User();
        $form_pass = $this->createForm(UserTypePasswordUpdate::class, $user_password);
        $form_pass->handleRequest($request);
        $response_pass = null;

        if ($form_pass->isSubmitted() && $form_pass->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $encoded_new = $encoder->encodePassword($user_password, $user_password->getPassword());
            $encoded_old = $encoder->encodePassword($user_password, $form_pass->get("old_password")->getData());

            if ($encoded_old == $user->getPassword()) {
                $user->setPassword($encoded_new);
                $em->flush();
                $response_pass = [
                    'success' => true,
                    'message' => 'Votre mot de passe a été mis à jour'
                ];
            } else {
                $response_pass = [
                    'success' => false,
                    'message' => 'Le mot de passe est incorrect'
                ];
            }
        }
        
        return $this->render('AppBundle:User:account.html.twig', [
            'form_info' => $form_info->createView(),
            'form_pass' => $form_pass->createView(),
            'user' => $user,
            'form_info_response' => $response_info,
            'form_pass_response' => $response_pass
        ]);
    }
}