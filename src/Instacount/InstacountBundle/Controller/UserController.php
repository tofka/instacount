<?php

namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Instacount\InstacountBundle\Entity\User;
use Instacount\InstacountBundle\Form\UserType;
use Symfony\Component\Security\Core\SecurityContext;

class UserController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()
                   ->getManager();
        $users = $em->getRepository('InstacountInstacountBundle:User')
                    ->findAll();
        return $this->render('InstacountInstacountBundle:User:index.html.twig', array(
            'users' => $users
        ));
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
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password_from_form = $form->get('password')->getData();
            $password = $encoder->encodePassword($password_from_form, $user->getSalt());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
         
            return $this->redirect($this->generateUrl('InstacountInstacountBundle_user_show', array(
                'id' => $user->getId()))
            );
        }
    }

    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('InstacountInstacountBundle:User')->find($id);
        if (!$user) {
            throw $this->createNotFoundException('Unable to find User.');
        }

        return $this->render('InstacountInstacountBundle:User:show.html.twig', array(
            'user' => $user));
    }
  
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('InstacountInstacountBundle:User')->find($id);
        if (!$user) {
            throw $this->createNotFoundException('Unable to find user.');
        }
        $form = $this->createForm(new UserType(), $user);       
        return $this->render('InstacountInstacountBundle:User:edit.html.twig', array(
            'user'   => $user,
            'form'   => $form->createView(),           
        ));
    }
  
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('InstacountInstacountBundle:User')->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
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
  
    public function deleteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('InstacountInstacountBundle:User')->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }     
        $em->remove($user);
        $em->flush();            

        return $this->redirect($this->generateUrl('InstacountInstacountBundle_user'));
    }   

    public function loginAction(){
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'InstacountInstacountBundle:Security:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }
}