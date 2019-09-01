<?php

namespace AloneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class StartController extends Controller
{
    /**
     * @Route("/", name="alone_start")
     */
    public function indexAction()
    {
        return $this->render('@Alone/alone_start.html.twig');
    }
}
