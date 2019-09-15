<?php


namespace AloneBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use AloneBundle\Entity\Survey;

/**
 * @ORM\Entity
 * @ORM\Table(name="question")
 */
class Question
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=100)
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $answer;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $optionalAnswer;

    /**
     * @ORM\ManyToOne(targetEntity="Survey", inversedBy="questions")
     */
    private $survey;

    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getAnswer() {
        return $this->answer;
    }

    public function setAnswer($answer) {
        $this->answer = $answer;
    }

    public function getoptionalAnswer() {
        return $this->optionalAnswer;
    }

    public function setoptionalAnswer($optionalAnswer) {
        $this->optionalAnswer = $optionalAnswer;
    }

    public function getSurvey() {
        return $this->survey;
    }

    public function setSurvey($survey) {
        $this->survey = $survey;
    }
}
