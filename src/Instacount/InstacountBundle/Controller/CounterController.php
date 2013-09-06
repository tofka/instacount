<?php


namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Instacount\InstacountBundle\Entity\Counter;
use Instacount\InstacountBundle\Form\CounterType;

class CounterController extends Controller
{
    public function indexAction() {


    return $this->render('InstacountInstacountBundle:Counter:index.html.twig');

    }

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

        $form = $this->createForm(new CounterType(), $counter);
        $form->bind($request);      
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($counter);
            $em->flush();
         
             return $this->redirect($this->generateUrl('InstacountInstacountBundle_counter_show', array(
                'id' => $counter->getId()))
            );
            
            
        }
    }
}