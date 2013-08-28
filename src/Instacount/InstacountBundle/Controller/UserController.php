<?php


namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        return $this->render('InstacountInstacountBundle:User:index.html.twig');
    }

    public function showAction()
    {
        return $this->render('InstacountInstacountBundle:User:show.html.twig');
    }

    public function newAction()
    {
        return $this->render('InstacountInstacountBundle:User:new.html.twig');
    }

    public function editAction()
    {
        return $this->render('InstacountInstacountBundle:User:edit.html.twig');
    }
}