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

            $userRepo = $this->get('app.entity.user');
            
            if (!$userRepo->findOneBy(['username' => $user->getUsername(), 'email' => $user->getEmail()])) {
                $em = $this->getDoctrine()->getManager();

                $user->setSalt('');
                $user->setRoles(array('ROLE_USER'));
                $user->setWatchlist($watchlist);

                $em->persist($watchlist);
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('user_login');
            } else {
                if ($userRepo->findOneBy(['username' => $user->getUsername()])) {
                    // set error username deja pris
                } else if ($userRepo->findOneBy(['email' => $user->getEmail()])) {
                    // set error email dejà pris
                }
            }
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