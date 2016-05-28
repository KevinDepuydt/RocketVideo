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

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        // just setup a fresh $task object (remove the dummy data)
        $stream = new Stream();

        $form = $this->createFormBuilder($stream)
            ->add('path', TextType::class, array(
                'label' => false,
                'attr' => array(
                    'class' => 'input-add-video',
                    'placeholder' => 'Coller le lien de la vidéo ici'
                )
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Charger la vidéo',
                'attr' => array(
                    'class' => 'btn-add-video'
                )
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($stream);
            $em->flush();

            $request->getSession()->set('form_message', 'Annonce bien enregistrée.');

            return $this->redirectToRoute('homepage');
        }

        // replace this example code with whatever you need
        return $this->render('AppBundle::index.html.twig', [
            'form' => $form->createView()
        ]);

    }
}
