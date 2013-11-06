<?php

namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Instacount\InstacountBundle\Form\CounterType;
use Instacount\InstacountBundle\Entity\Counter;

class PageController extends Controller {
    public function indexAction() {
// Undersök om det finns någon user skapad, om inte skapa en första user:
        $em = $this->getDoctrine()->getManager();
        $check_users = $em->getRepository('InstacountInstacountBundle:User')->findOneByIsActive(true);
        if (!$check_users) {
            $user = new User();        
            $form_first = $this->createForm(new UserType(), $user);
            return $this->render('InstacountInstacountBundle:User:new_first.html.twig', array(
                'user' => $user,
                'form' => $form_first->createView()
            ));
        }
// Om users finns, undersök om det är dags att spara nya counts:
        else {
            $form = $this->createFormBuilder()
                ->add('data', 'textarea')
                ->add('position', 'textarea')  
                ->add('fb', 'textarea')      
                ->getForm();
            $today = new \DateTime();
            $now_sub = $today->format("Y-m-d 00:00:00");
            $em = $this->getDoctrine()->getManager();
            $campaigns = $em->getRepository('InstacountInstacountBundle:Campaign')->findAll();
// Kolla om det finns någon rad sparad idag:
            $query = $em->createQuery(
                    'SELECT c
                    FROM InstacountInstacountBundle:Counter c
                    WHERE c.timestamp > :time')
                    ->setParameters(array(
                        'time'  => $now_sub
                    ));     
            $time_check = $query->getResult();
// Om inget finns sparat idag, gå till update-dialog:
            if(!$time_check) {
                return $this->render('InstacountInstacountBundle:Counter:update.html.twig', array(
                    'campaigns' => $campaigns,
                    'form'   => $form->createView()
                    ));
            }
// Om det finns rader sparade idag, kolla om det finns kampanjer som inte är uppdaterade (som alltså har lagts till efter senaste uppd):
            else {  
                $counters = $em->getRepository('InstacountInstacountBundle:Counter')->findAll();
                $counter = new Counter();
                $form_select = $this->createForm(new CounterType(), $counter);
// Kolla om alla kampanjer finns med i countertabellen, om inte spara counts för dem som inte finns med:
                $campaigns_to_update = array();
                foreach($campaigns as $campaign){
                    $counter_by_campaign = $em->getRepository('InstacountInstacountBundle:Counter')->findOneByCampaign($campaign);
                    if(!$counter_by_campaign) {
                        array_push($campaigns_to_update, $campaign);
                    }
                }                                    
                if (empty($campaigns_to_update)) {
                    return $this->render('InstacountInstacountBundle:Page:index.html.twig', array(
                        'campaigns' => $campaigns,
                        'counter' => $counter,                
                        'form_select' => $form_select->createView()      
                    ));
                }
                else {
                    return $this->render('InstacountInstacountBundle:Counter:update.html.twig', array(
                        'campaigns' => $campaigns_to_update,
                        'form'   => $form->createView()
                        ));
                }
            }
        }
    }
}
