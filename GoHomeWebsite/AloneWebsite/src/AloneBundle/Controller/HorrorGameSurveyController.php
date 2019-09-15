<?php

namespace AloneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AloneBundle\Enum\QuestionType;
use AloneBundle\Form\HorrorIsForMeType;
use AloneBundle\Form\HorrorGamesShouldBeType;
use AloneBundle\Form\IPlayHorrorBecauseType;
use AloneBundle\Form\IWantToPlayType;
use AloneBundle\Form\MostImportantThingsType;
use AloneBundle\Entity\Question;
use AloneBundle\Entity\Survey;

class HorrorGameSurveyController extends Controller
{
    /**
     * @Route("/survey_start", name="alone_survey_start")
     */
    public function indexAction()
    {
        return $this->render('@Alone/Survey/survey_start.html.twig');
    }

    /**
     * @Route("/survey_create", name="alone_survey_create")
     */
    public function createSurvey() {

        $survey = new Survey();
        $this->saveToDB($survey);

        return $this->redirectToRoute(
            'alone_survey_filling_out',
            array(
                'surveyId'   => $survey->getId(),
                'surveyStep' => QuestionType::STEP_HORROR_FOR_ME,
            )
        );
    }

    /**
     * @Route("/survey/{surveyId}/{surveyStep}", name="alone_survey_filling_out")
     */
    public function questionAction(Request $request,$surveyId, $surveyStep)
    {
        $question = new Question();
        $form = $this->getFormForStep($surveyStep, $question);
        $form->handleRequest($request);

        $survey = $this->getDoctrine()->getManager()->getRepository(Survey::class)->find($surveyId);

        if($survey->getisOpen() == false) {
            return $this->redirectToRoute(
                'alone_GoHome_start'
            );
        }

        if($form->isSubmitted()) {
            $question->setSurvey($survey);
            $this->saveToDB($question);

            $surveyStep++;

            if($surveyStep == 5) {
                return $this->redirectToRoute(
                    'alone_survey_finished',
                    array(
                        'surveyId' => $survey->getId(),
                    )
                );
            }

            return $this->redirectToRoute(
                'alone_survey_filling_out',
                array(
                    'surveyId' => $survey->getId(),
                    'surveyStep' => $surveyStep,
                )
            );
        }

        return $this->render(
            '@Alone/Survey/survey.html.twig',
            array(
                'step' => $surveyStep,
                'form' => $form->createView()
            )
        );
    }

    /**
     * @Route("/survey_finished/{surveyId}", name="alone_survey_finished")
     */
    public function finishedSurvey($surveyId) {

        $survey = $this->getDoctrine()->getManager()->getRepository(Survey::class)->find($surveyId);

        $survey->close();

        return $this->render(
            '@Alone/Survey/survey_finished.html.twig',
            array(
                'surveyId'   => $survey->getId(),
            )
        );
    }

    private function getFormForStep($step, $question)
    {
        $form = null;

        switch ($step) {
            case QuestionType::NO_STEP:
                die("Step no step!");
                break;
            
            case QuestionType::STEP_HORROR_FOR_ME:
                $form = $this->createForm(HorrorIsForMeType::class, $question);
            break;

            case QuestionType::STEP_MOST_IMPORTANT_THING:
                $form = $this->createForm(MostImportantThingsType::class, $question);
            break;

            case QuestionType::STEP_I_WANT_TO_PLAY_WHERE:
            $form = $this->createForm(IWantToPlayType::class, $question);
            break;

            case QuestionType::STEP_I_PLAY_HORROR_GAMES_BECAUSE:
                $form = $this->createForm(IPlayHorrorBecauseType::class, $question);
            break;

            case QuestionType::STEP_HORROR_GAMES_SHOULD_BE:
                $form = $this->createForm(HorrorGamesShouldBeType::class, $question);
            break;
        }

        return $form;
    }

    /**
     * 
     */
    private function saveToDB($object){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($object);
        $entityManager->flush();
    }
}
