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

    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $counter = $em->getRepository('InstacountInstacountBundle:Counter')->find($id);
        if (!$counter) {
            throw $this->createNotFoundException('Unable to find counter.');
        }

        return $this->render('InstacountInstacountBundle:Counter:show.html.twig', array(
            'counter' => $counter));
    }
    
    public function createAction(Request $request) {
        $counter  = new Counter();
        $counter->setTimestamp(new \DateTime('now'));
        $form = $this->createForm(new CounterType(), $counter);
        $form->bind($request);      
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();       
// Kolla om detta kampanj-id redan finns sparat i count inom visst intervall:               
            $campaign_id = $form->get('campaign')->getData();
            $now_minus = new \DateTime('-1 hour');
            $query = $em->createQuery(
                'SELECT c
                FROM InstacountInstacountBundle:Counter c
                WHERE c.campaign = :campaign
                AND c.timestamp > :time')
                ->setParameters(array(
                    'campaign' => $campaign_id,
                    'time'  => $now_minus
                )); 
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
        }
    }

    public function chartAction($campaign_id) {
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
            array('label' => 'count', 'type' => 'number')
        );
        foreach($result as $r) { 
            $date = "Date(";
            $date .= $r->getTimestamp()->format('Y,m,d');
            $date .= ")";
            
             
            $temp = array();
            $temp[] = array(
                'v' => $date); 
            $temp[] = array(
                'v' => $r->getCount()); 
            $rows[] = array('c' => $temp);
        }
        $table['rows'] = $rows;
        $jsonTable = json_encode($table);

        return $response = new Response($jsonTable);
    }
}