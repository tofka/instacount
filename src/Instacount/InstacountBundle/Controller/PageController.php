<?php
// src/Instacount/InstacountBundle/Controller/PageController.php

namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Instacount\InstacountBundle\Form\CampaignType;
use Instacount\InstacountBundle\Entity\Campaign;



class PageController extends Controller
{
    public function indexAction() {
    	$em = $this->getDoctrine()
                   ->getEntityManager();
        $campaigns = $em->getRepository('InstacountInstacountBundle:Campaign')
                    ->findAll();

        return $this->render('InstacountInstacountBundle:Page:index.html.twig', array(
            'campaigns' => $campaigns
        ));
    }
}
