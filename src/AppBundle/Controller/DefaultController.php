<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Stream;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\StreamType;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        $stream = new Stream();
        $streamRepo = $this->get('app.entity.stream');

        $form = $this->createForm(StreamType::class, $stream);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                $user = $this->get('security.token_storage')->getToken()->getUser();
                $stream->setPublic(false);
                $stream->setUser($user);
            }

            // File name
            do {
                $stream->setName(uniqid());
            } while ($streamRepo->findByName($stream->getName()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($stream);
            $em->flush();

            if (!$stream->isPublic()) {
                return $this->redirectToRoute('user_account');
            }

            $form = $this->createForm(StreamType::class, new Stream());
        }

        return $this->render('AppBundle::index.html.twig', [
            'form' => $form->createView(),
            'public_streams' => $this->getDoctrine()
                ->getRepository('AppBundle:Stream')
                ->findByPublic(true)
        ]);
    }

    public function playAction($id)
    {
        $stream = $this->getDoctrine()
            ->getRepository('AppBundle:Stream')
            ->find($id);

        if (!$stream) {
            throw $this->createNotFoundException('The video does not exist');
        } else {

            if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                $user = $this->get('security.token_storage')->getToken()->getUser();
            }

            if ($stream->getState() != Stream::STREAM_DOWNLOADED || !$stream->isPublic() && isset($user) && $user != $stream->getUser()) {
                $stream = null;
            }
        }

        return $this->render('AppBundle::play.html.twig', [
            'stream' => $stream,
            'show_edit' => isset($user) ? $user == $stream->getUser() : false,
        ]);
    }
    
    public function testMailAction() {
        $name = "Kevin";
        $message = \Swift_Message::newInstance()
            ->setSubject('Envoie d\'un email de test')
            ->setFrom(['rocketvideosup@gmail.com' => "Rocket Vidéo"])
            ->setTo('kevin.dpdt@gmail.com')
            ->setContentType('text/html')
            ->setBody(
                $this->renderView(
                    'AppBundle:Emails:video_downloaded.html.twig',
                    array('stream_id' => 1)
                )
            )
        ;
        $this->get('mailer')->send($message);
        return $this->redirectToRoute('app_index');
    }
}
