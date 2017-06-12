<?php


namespace AppBundle\Entity\Service;

use AppBundle\Entity\Question;
use AppBundle\Entity\Choice;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\CommandRepository;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ChoiceCommandRepository
 * @package AppBundle\Entity\Service
 */
class ChoiceCommandRepository implements CommandRepository
{

    private $entityManager;

    /**
     * ChoiceCommandRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $object
     */
    public function save($object)
    {
        // TODO: Implement save() method.
    }

    /**
     * @param $object
     */
    public function remove($object)
    {
        // TODO: Implement remove() method.
    }

    /**
     * Edit and posibly remove the relationship between the choice and the Question
     *
     * @param ArrayCollection $choices
     * @param Question $question
     * @return Question
     */
    public function edit(ArrayCollection $choices, Question $question) {
        foreach ($choices as $choice) {
            if (false === $question->getChoices()->contains($choice)) {
                $choice->setQuestion(null);
                $this->entityManager->remove($choice);
            }
        }
        return $question;
    }

}