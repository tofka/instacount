<?php

namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Instacount\InstacountBundle\Entity\User;
use Instacount\InstacountBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UserController extends Controller
{
    public function indexAction() {
        $em = $this->getDoctrine()
                   ->getEntityManager();

        $users = $em->getRepository('InstacountInstacountBundle:User')
                    ->findAll();

        return $this->render('InstacountInstacountBundle:User:index.html.twig', array(
            'users' => $users
        ));
    }

    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('InstacountInstacountBundle:User')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find User.');
        }

        return $this->render('InstacountInstacountBundle:User:show.html.twig', array(
            'user' => $user));
    }

  
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('InstacountInstacountBundle:User')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find user.');
        }

        $form = $this->createForm(new UserType(), $user);
        
        return $this->render('InstacountInstacountBundle:User:edit.html.twig', array(
            'user'      => $user,
            'form'   => $form->createView(),
            'id' => $id           
        ));
    }
  
  public function updateAction(Request $request, $id)
{
    $em = $this->getDoctrine()->getManager();
    $user = $em->getRepository('InstacountInstacountBundle:User')->find($id);

    if (!$user) {
        throw $this->createNotFoundException(
            'No product found for id '.$id
        );
    }
    $form = $this->createForm(new UserType(), $user);
    $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

    return $this->redirect($this->generateUrl('InstacountInstacountBundle_user'));
}
    public function updatedAction(Request $request, $id) {
        $user = $em->getRepository('InstacountInstacountBundle:User')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find user.');
        }

        $form = $this->createForm(new UserType(), $user);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('InstacountInstacountBundle_user_index')
            );
        }  
        else {
            throw $this->createNotFoundException('Unable to find user.');
        }  
    }
       
    public function newAction() {
        $user = new User();        
        $form   = $this->createForm(new UserType(), $user);
        return $this->render('InstacountInstacountBundle:User:new.html.twig', array(
            'user' => $user,
            'form'   => $form->createView()
        ));
    }

    public function createAction(Request $request) {
        $user  = new User();
        $form = $this->createForm(new UserType(), $user);
        $form->bind($request);
      
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
         
            return $this->redirect($this->generateUrl('InstacountInstacountBundle_user_show', array(
                'id' => $user->getId()))
            );
        }
    }
}