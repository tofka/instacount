<?php

namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Instacount\InstacountBundle\Form\CounterType;
use Instacount\InstacountBundle\Entity\Counter;

class PageController extends Controller {
    public function indexAction() {
    	$em = $this->getDoctrine()->getEntityManager();
        $counters = $em->getRepository('InstacountInstacountBundle:Counter')->findAll();
        $campaigns = $em->getRepository('InstacountInstacountBundle:Campaign')->findAll();
        $form = $this->createFormBuilder()
        ->add('data', 'textarea')        
        ->getForm();

        $counter = new Counter();
        $form_select = $this->createForm(new CounterType(), $counter);

        return $this->render('InstacountInstacountBundle:Page:index.html.twig', array(
            'campaigns' => $campaigns,
            'counter' => $counter,
            'form'   => $form->createView(),
            'form_select' => $form_select->createView()
                     
        ));
    }
}
