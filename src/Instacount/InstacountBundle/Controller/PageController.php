<?php
// src/Instacount/InstacountBundle/Controller/PageController.php

namespace INstacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('InstacountInstacountBundle:Page:index.html.twig');
    }
}
