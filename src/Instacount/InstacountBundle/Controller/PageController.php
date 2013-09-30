<?php

namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Instacount\InstacountBundle\Form\CounterType;
use Instacount\InstacountBundle\Entity\Counter;

class PageController extends Controller {
    public function indexAction() {
    	$em = $this->getDoctrine()->getEntityManager();
        $campaigns = $em->getRepository('InstacountInstacountBundle:Campaign')->findAll();
        $counter = new Counter();                  
        $form   = $this->createForm(new CounterType(), $counter);
        return $this->render('InstacountInstacountBundle:Page:index.html.twig', array(
            'counter' => $counter,
            'campaigns' => $campaigns,
            'form'   => $form->createView()            
        ));
    }
}
