<?php


namespace AloneBundle\Entity;
use AloneBundle\Entity\Question;
use Doctrine\Common\Collections\ArrayCollection;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="survey")
 */
class Survey
{

    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    
    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="survey")
     */
    private $questions;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $isOpen;

    public function __construct() {
        $this->questions = new ArrayCollection();
        $this->createdAt = new \Datetime('now');
        $this->isOpen    = true;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt(Datetime $createdAt) {
        $this->createdAt = $createdAt;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getisOpen() {
        return $this->isOpen;
    }

    public function setIsOpen($isOpen) {
        $this->isOpen = $isOpen;
    }

    //Readability +10 :)
    public function close() {
        $this->setIsOpen(false);
    }
}
