<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Stream;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Form\Type\StreamType;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        $stream = new Stream();

        $form = $this->createForm(StreamType::class, $stream);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($stream);
            $em->flush();

            return $this->redirectToRoute('app_play', array('id' => $stream->getId()));
        }

        return $this->render('AppBundle::index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function playAction($id)
    {
        $stream = $this->getDoctrine()
            ->getRepository('AppBundle:Stream')
            ->find($id);

        if (!$stream) {
            throw $this->createNotFoundException('The product does not exist');
        }

        return $this->render('AppBundle::play.html.twig', [
            'stream' => $stream
        ]);

    }
}
