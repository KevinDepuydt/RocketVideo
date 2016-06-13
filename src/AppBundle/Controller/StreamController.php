<?php
/**
 * Created by PhpStorm.
 * User: KevinSup
 * Date: 13/06/2016
 * Time: 13:36
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Stream;
use AppBundle\Form\Type\StreamTypeEdit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\StreamType;

class StreamController extends Controller
{
    public function editAction(Request $request, $id)
    {
        $stream = $this->getDoctrine()
            ->getRepository('AppBundle:Stream')
            ->find($id);

        if (!$stream) {
            throw $this->createNotFoundException('The video does not exist');
        }

        // security block
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            if ($stream->isPublic() || !$stream->isPublic() && $stream->getUser()->getId() != $user->getId()) {
                return $this->redirectToRoute('user_account');
            }
        } else {
            return $this->redirectToRoute('app_index');
        }

        $form = $this->createForm(StreamTypeEdit::class, $stream);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }
        
        return $this->render('AppBundle:Stream:edit.html.twig', [
            'form' => $form->createView(),
            'stream' => $stream
        ]);

    }
}
