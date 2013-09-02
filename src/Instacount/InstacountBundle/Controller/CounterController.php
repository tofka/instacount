<?php


namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Instacount\InstacountBundle\Entity\Counter;
use Instacount\InstacountBundle\Form\CounterType;

class CounterController extends Controller
{
    public function indexAction(Request $request) {

    	$counter  = new Counter();
        $form = $this->createForm(new CounterType(), $counter);
        $form->bind($request);      
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($counter);
            $em->flush();
         
            return $this->redirect($this->generateUrl('InstacountInstacountBundle_homepage'));
        }
        //return $this->render('InstacountInstacountBundle:Page:index.html.twig', array(
        	'counter' => $counter,
            'form'   => $form->createView()));
    }
}