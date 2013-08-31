<?php


namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Instacount\InstacountBundle\Entity\Campaign;
use Instacount\InstacountBundle\Form\CampaignType;

class CampaignController extends Controller
{
    public function indexAction() {
        $em = $this->getDoctrine()
                   ->getEntityManager();
        $campaigns = $em->getRepository('InstacountInstacountBundle:campaign')
                    ->findAll();
        return $this->render('InstacountInstacountBundle:Campaign:index.html.twig', array(
            'campaigns' => $campaigns
        ));
    }

    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $campaign = $em->getRepository('InstacountInstacountBundle:Campaign')->find($id);
        if (!$campaign) {
            throw $this->createNotFoundException('Unable to find campaign.');
        }

        return $this->render('InstacountInstacountBundle:Campaign:show.html.twig', array(
            'campaign' => $campaign));
    }
  
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();
        $campaign = $em->getRepository('InstacountInstacountBundle:Campaign')->find($id);
        if (!$campaign) {
            throw $this->createNotFoundException('Unable to find campaign.');
        }
        $form = $this->createForm(new CampaignType(), $campaign);       
        return $this->render('InstacountInstacountBundle:Campaign:edit.html.twig', array(
            'campaign'      => $campaign,
            'form'   => $form->createView(),           
        ));
    }
  
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $campaign = $em->getRepository('InstacountInstacountBundle:Campaign')->find($id);
        if (!$campaign) {
            throw $this->createNotFoundException(
                'No campaign found for id '.$id
            );
        }
        $form = $this->createForm(new CampaignType(), $campaign);
        $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($campaign);
                $em->flush();
            }

        return $this->redirect($this->generateUrl('InstacountInstacountBundle_campaign'));
    }
  
    public function deleteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $campaign = $em->getRepository('InstacountInstacountBundle:Campaign')->find($id);
        if (!$campaign) {
            throw $this->createNotFoundException(
                'No campaign found for id '.$id
            );
        }       
        $em->remove($campaign);
        $em->flush();            

        return $this->redirect($this->generateUrl('InstacountInstacountBundle_campaign'));
    }

    public function newAction() {
        $campaign = new Campaign();        
        $form   = $this->createForm(new CampaignType(), $campaign);
        return $this->render('InstacountInstacountBundle:Campaign:new.html.twig', array(
            'campaign' => $campaign,
            'form'   => $form->createView()
        ));
    }

    public function createAction(Request $request) {
        $campaign  = new Campaign();
        $form = $this->createForm(new CampaignType(), $campaign);
        $form->bind($request);      
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($campaign);
            $em->flush();
         
            return $this->redirect($this->generateUrl('InstacountInstacountBundle_campaign_show', array(
                'id' => $campaign->getId()))
            );
        }
    }
}