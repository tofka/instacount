<?php

namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Instacount\InstacountBundle\Form\CounterType;
use Instacount\InstacountBundle\Entity\Counter;

class PageController extends Controller {
    public function indexAction() {
        $counter = new Counter();    
        $counter->settimestamp(new \DateTime('now'));
       
        $form   = $this->createForm(new CounterType(), $counter);
        return $this->render('InstacountInstacountBundle:Page:index.html.twig', array(
            'counter' => $counter,
            'form'   => $form->createView()
            
        ));
    }
}
