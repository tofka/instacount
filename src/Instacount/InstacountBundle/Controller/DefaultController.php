<?php

namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('InstacountInstacountBundle:Default:index.html.twig', array('name' => $name));
    }
}
