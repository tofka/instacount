<?php

namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Instacount\InstacountBundle\Entity\Counter;
use Instacount\InstacountBundle\Form\CounterType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

class CounterController extends Controller {

    public function indexAction() {
        // mySql: "select * from (select * from counter ORDER BY id DESC) AS x GROUP BY campaign_id"
        // Denna plockar ut campaign_id som unika värden med det senaste id:t. Men jag kan inte skriva den
        // i doctrine, så istället plockar jag ut hur många unika värden det finns för campaign_id och sätter
        // den siffran som limit för hur många counts som ska plockas ut.
        $em = $this->getDoctrine()->getEntityManager();
        // mySql, måste joina för att campaign_id är fk i counter: SELECT DISTINCT campaign_id FROM counter INNER JOIN campaign ON counter.campaign_id = campaign.id  
        $query = $em->createQuery('SELECT DISTINCT x.id FROM InstacountInstacountBundle:Campaign x 
            join InstacountInstacountBundle:Counter c WHERE x.id = c.campaign');
        $count = $query->getResult();
        $limit = count($count);

        $qb = $em->createQueryBuilder();
        $qb->add('select', 'c')
        ->add('from', 'InstacountInstacountBundle:Counter c')
        ->add('orderBy', 'c.id DESC')
        ->setMaxResults( $limit );
        $counts = $qb->getQuery()->getResult();        

        return $this->render('InstacountInstacountBundle:Counter:index.html.twig', array(
            'counts' => $counts,
            'limit' => $limit,
            )
        );
    }
    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $counter = $em->getRepository('InstacountInstacountBundle:Counter')->find($id);
        if (!$counter) {
            throw $this->createNotFoundException('Kunde inte hitta räknare nr' . $id);
        }

        return $this->render('InstacountInstacountBundle:Counter:show.html.twig', array(
            'counter' => $counter));
    }

    public function showLastCountAction(Request $request) {
        $counter  = new Counter();
        $form = $this->createForm(new CounterType(), $counter);
        $form->bind($request); 
        $campaign_id = $form->get('campaign')->getData(); 
        $repository = $this->getDoctrine()->getRepository('InstacountInstacountBundle:Counter');
        $counter = $repository->findOneByCampaign(
            array('campaign_id' => $campaign_id),
            array('id' => 'DESC')
        );
        return $this->redirect($this->generateUrl('InstacountInstacountBundle_counter_show', array(
            'id' => $counter->getId()))
        );
    }
    public function createAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        $campaigns = $em->getRepository('InstacountInstacountBundle:Campaign')->findAll();
       
        $counter_form = new Counter();
        $form_select = $this->createForm(new CounterType(), $counter_form);
        $form = $this->createFormBuilder()
        ->add('data', 'textarea')        
        ->getForm();
        $form->handleRequest($request);
        $counts = $form->get('data')->getData();
        $json = json_decode($counts, true); 
// Spara counters till databas
        foreach ($json as $value) {                      
            $counter = new Counter();
            $tag = $value["tag"]; 
            $count = $value["count"];       
            $em = $this->getDoctrine()->getEntityManager();            
            $campaign = $em->getRepository('InstacountInstacountBundle:Campaign')->findOneByTag($tag);
            $counter->setCampaign($campaign);
            $counter->setTimestamp(new \DateTime('now'));
            $counter->setCount($count);     
                $em = $this->getDoctrine()->getManager();
                $em->persist($counter);
                $em->flush();                
        }
        
        return $this->render('InstacountInstacountBundle:Page:index.html.twig', array(
            'counter_form' => $counter_form,
            'campaigns' => $campaigns,
            'form_select' => $form_select->createView()   
            )); 
 
 


// Gamla funktionen:


/*
        $counter  = new Counter();
        $counter->setTimestamp(new \DateTime('now'));
        $form = $this->createForm(new CounterType(), $counter);
        $form->bind($request);      
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();       
// Kolla om detta kampanj-id redan finns sparat i count inom visst intervall.
            $campaign_id = $form->get('campaign')->getData();
            $today = new \DateTime();
            $now_sub = $today->format("Y-m-d 00:00:00");
            $query = $em->createQuery(
                'SELECT c
                FROM InstacountInstacountBundle:Counter c
                WHERE c.campaign = :campaign
                AND c.timestamp > :time')
                ->setParameters(array(
                    'campaign' => $campaign_id,
                    'time'  => $now_sub
                )); 
// Om $check är tom så sparas en ny count, annars visas den senaste.               
            $check = $query->getResult();
            if (empty($check)) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($counter);
                $em->flush();
            
                return $this->redirect($this->generateUrl('InstacountInstacountBundle_counter_show', array(
                'id' => $counter->getId()))
                );            
            }
            else {
                $repository = $this->getDoctrine()->getRepository('InstacountInstacountBundle:Counter');
                $counter = $repository->findOneByCampaign(
                    array('campaign_id' => $campaign_id),
                    array('id' => 'DESC')
                );
                return $this->redirect($this->generateUrl('InstacountInstacountBundle_counter_show', array(
                'id' => $counter->getId()))
                );
            }
        }*/
    }

    public function jsonAction($campaign_id) {
        $repository = $this->getDoctrine()
        ->getRepository('InstacountInstacountBundle:Counter');
        $query = $repository->createQueryBuilder('c')
            ->where('c.campaign = :campaign_id')
            ->setParameter('campaign_id', $campaign_id)            
            ->getQuery();
        $result = $query->getResult();
        $rows = array();
        $table = array();
        $table['cols'] = array(
            array('label' => 'timestamp', 'type' => 'date'),
            array('label' => 'tags', 'type' => 'number')
        );
        foreach($result as $r) {
            $timestamp = $r->getTimestamp();
            $date_modify = $timestamp->modify('-1 month');
            $date = "Date(" . $date_modify->format('Y,m,d') . ")";   // Datumformat till googlechart-tabell 
            $count = $r->getCount();          
            $temp = array();
            $temp[] = array('v' => $date); 
            $temp[] = array('v' => $count); 
            $rows[] = array('c' => $temp);
        }
        $table['rows'] = $rows;
        
        return $this->render('InstacountInstacountBundle:Counter:json.json.twig', array(
            'table' => $table));        
    }

    public function chartAction($campaign_id) {
        $em = $this->getDoctrine()->getEntityManager();
        $campaign = $em->getRepository('InstacountInstacountBundle:Campaign')->find($campaign_id);
        $repository = $this->getDoctrine()->getRepository('InstacountInstacountBundle:Counter');
        $counter = $repository->findOneByCampaign(
                    array('campaign_id' => $campaign_id),
                    array('id' => 'DESC')
                );
        return $this->render('InstacountInstacountBundle:Counter:chart.html.twig', array(
            'campaign_id' => $campaign_id,
            'campaign' => $campaign,
            'counter' => $counter->getId()
            ));  
    }
}