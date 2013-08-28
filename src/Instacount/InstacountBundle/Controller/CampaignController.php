<?php


namespace Instacount\InstacountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CampaignController extends Controller
{
    public function indexAction()
    {
        return $this->render('InstacountInstacountBundle:Campaign:index.html.twig');
    }

    public function showAction()
    {
        return $this->render('InstacountInstacountBundle:Campaign:show.html.twig');
    }

    public function newAction()
    {
        return $this->render('InstacountInstacountBundle:Campaign:new.html.twig');
    }

    public function editAction()
    {
        return $this->render('InstacountInstacountBundle:Campaign:edit.html.twig');
    }
}