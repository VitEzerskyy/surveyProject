<?php


namespace AppBundle\Entity\Repository\Choice;

use AppBundle\Entity\Question;
use AppBundle\Entity\Choice;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\WriteRepository;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ChoiceWriteRepository
 * @package AppBundle\Entity\Repository
 */
class ChoiceWriteRepository implements WriteRepository
{

    private $entityManager;

    /**
     * ChoiceWriteRepository constructor.
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
     * @throws \Exception
     */
    public function edit(ArrayCollection $choices, Question $question) {
        try {
        foreach ($choices as $choice) {
            if (false === $question->getChoices()->contains($choice)) {
                $choice->setQuestion(null);
                $this->entityManager->remove($choice);
            }
        }
            return $question;
        }catch (\Exception $e) {
            throw new \Exception("Something went wrong. Can't edit Question");
        }

    }
}