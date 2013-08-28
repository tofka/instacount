<?php


namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CounterController extends Controller
{
    public function indexAction()
    {
        return $this->render('InstacountInstacountBundle:Counter:index.html.twig');
    }
}