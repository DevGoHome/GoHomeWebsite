<?php

namespace AloneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GoHomeController extends Controller
{
    /**
     * @Route("/GoHome", name="alone_GoHome_start")
     */
    public function indexAction()
    {
        return $this->render('@Alone/GoHome/goHome_start.html.twig');
    }
}
