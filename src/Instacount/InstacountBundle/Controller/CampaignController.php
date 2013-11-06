<?php


namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Instacount\InstacountBundle\Entity\Campaign;
use Instacount\InstacountBundle\Entity\Counter;
use Instacount\InstacountBundle\Entity\User;
use Instacount\InstacountBundle\Form\CampaignType;
use Instacount\InstacountBundle\Form\CounterType;
use Doctrine\ORM\EntityRepository;

class CampaignController extends Controller
{
    public function countAction(Request $request) {
        $form = $this->createForm(new CounterType());
        $form->bind($request);      
        $campaign = $form->get('campaign')->getData();
        $id = $campaign->getId();
        $repository = $this->getDoctrine()->getRepository('InstacountInstacountBundle:Counter');
        $counter = $repository->findOneByCampaign(
            array('campaign_id' => $id),
            array('id' => 'DESC')
        );
        
        return $this->render('InstacountInstacountBundle:Counter:show.html.twig', array(
            'id' => $counter->getId(),
            'counter' => $counter
        ));
    }

    public function indexAction() {
        $em = $this->getDoctrine()
                   ->getManager();
        $campaigns = $em->getRepository('InstacountInstacountBundle:Campaign')
                    ->findAll();
        return $this->render('InstacountInstacountBundle:Campaign:index.html.twig', array(
            'campaigns' => $campaigns
        ));
    }

    public function newAction() {
        $campaign = new Campaign(); 
        $campaign->setStartDate(new \DateTime('now'));  
        $campaign->setEndDate(new \DateTime('now'));       
        $form   = $this->createForm(new CampaignType(), $campaign);
        return $this->render('InstacountInstacountBundle:Campaign:new.html.twig', array(
            'campaign' => $campaign,
            'form'   => $form->createView()
        ));
    }

    public function createAction(Request $request) {
        $campaign  = new Campaign();
        $user = $this->get('security.context')->getToken()->getUser();
        $campaign->setUser($user);      
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

    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
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
// Hämta alla counts för denna campaign och radera dem först.
        $em = $this->getDoctrine()->getManager();
        $counts = $em->getRepository('InstacountInstacountBundle:Counter')->findByCampaign($id);
        foreach ($counts as $counter) {
            $em->remove($counter);
        }            
        $em->remove($campaign);
        $em->flush();            

        return $this->redirect($this->generateUrl('InstacountInstacountBundle_campaign'));
    }
}