<?php


namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Instacount\InstacountBundle\Entity\User;
use Instacount\InstacountBundle\Form\UserType;

class UserController extends Controller
{
    public function indexAction()
    {
        return $this->render('InstacountInstacountBundle:User:index.html.twig');
    }

    public function showAction()
    {
        return $this->render('InstacountInstacountBundle:User:show.html.twig');
    }

    public function editAction()
    {
        return $this->render('InstacountInstacountBundle:User:edit.html.twig');
    }

    public function newAction()
    {
        $user = new User();
        
        $form   = $this->createForm(new UserType(), $user);

        return $this->render('InstacountInstacountBundle:User:new.html.twig', array(
            'user' => $user,
            'form'   => $form->createView()
        ));
    }

   public function createAction()
    {
        // toString nånting

        $user  = new User();
        $request = $this->getRequest();
        $form    = $this->createForm(new UserType(), $user);
        $form->bindRequest($request);


        if ($form->isValid()) {
            $em = $this->getDoctrine()
                ->getEntityManager();
            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl('InstacountInstacountBundle_user_show', array(
                'id' => '#user-' . $user->getId())
            ));
        }

        return $this->render('InstacountInstacountBundle:User:new.html.twig', array(
            'user' => $user,
            'form'    => $form->createView()
        ));
    }
}