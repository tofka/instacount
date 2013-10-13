<?php

namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Instacount\InstacountBundle\Form\CounterType;
use Instacount\InstacountBundle\Entity\Counter;

class PageController extends Controller {
    public function indexAction() {
        $form = $this->createFormBuilder()
            ->add('data', 'textarea')
            ->add('position', 'textarea')        
            ->getForm();
        $today = new \DateTime();
        $now_sub = $today->format("Y-m-d 00:00:00");
        $em = $this->getDoctrine()->getEntityManager();
        $campaigns = $em->getRepository('InstacountInstacountBundle:Campaign')->findAll();
// Kolla om det finns någon rad sparad idag:
        $query = $em->createQuery(
                'SELECT c
                FROM InstacountInstacountBundle:Counter c
                WHERE c.timestamp > :time'
                )
                ->setParameters(array(
                    'time'  => $now_sub
                ));     
        $time_check = $query->getResult();
// Om inget finns sparat idag, gå till dialog, annars, gå till startsida
        if(!$time_check) {
            return $this->render('InstacountInstacountBundle:Counter:update.html.twig', array(
                'campaigns' => $campaigns,
                'form'   => $form->createView(),));
        }
        else {     
            $counters = $em->getRepository('InstacountInstacountBundle:Counter')->findAll();
            $counter = new Counter();
            $form_select = $this->createForm(new CounterType(), $counter);

            return $this->render('InstacountInstacountBundle:Page:index.html.twig', array(
                'campaigns' => $campaigns,
                'counter' => $counter,                
                'form_select' => $form_select->createView(),                        
            ));
        }
    }
}
