<?php

namespace AloneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin/login", name="alone_admin_login")
     */
    public function indexAction()
    {
        return $this->render('@Alone/alone_start.html.twig');
    }
}
