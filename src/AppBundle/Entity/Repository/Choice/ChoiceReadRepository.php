<?php


namespace AppBundle\Entity\Repository\Choice;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Choice;
use AppBundle\Entity\Question;
use AppBundle\Entity\ReadRepository;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ChoiceReadRepository
 * @package AppBundle\Entity\Repository
 */
class ChoiceReadRepository implements ReadRepository
{
    private $entityManager;

    /**
     * ChoiceReadRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * get all choices from Question
     *
     * @param Question|null $question
     * @return bool|ArrayCollection
     */
    public function getAll(Question $question = null)
    {
        if ($question) {
            $originalChoices = new ArrayCollection();
            foreach ($question->getChoices() as $choice) {
                $originalChoices->add($choice);
            }
            return $originalChoices;
        }
        return false;
    }

    /**
     * @param $id
     */
    public function findById($id)
    {
        // TODO: Implement findById() method.
    }
}