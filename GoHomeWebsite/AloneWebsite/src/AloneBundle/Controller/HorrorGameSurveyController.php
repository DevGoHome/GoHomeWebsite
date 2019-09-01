<?php

namespace AloneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HorrorGameSurveyController extends Controller
{
    /**
     * @Route("/survey", name="alone_survey_start")
     */
    public function indexAction()
    {
        return $this->render('@Alone/alone_start.html.twig');
    }
}
