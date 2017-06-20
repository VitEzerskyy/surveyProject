<?php

namespace AppBundle\Entity\Repository\Question;

use AppBundle\Entity\Question;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\ReadRepository;

/**
 * Class QuestionReadRepository
 * @package AppBundle\Entity\Repository
 */
class QuestionReadRepository implements ReadRepository
{
    private $entityManager;

    /**
     * QuestionReadRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * get all questions
     *
     * @return Question[]|array
     */
    public function getAll()
    {
        $questions = $this->entityManager->getRepository('AppBundle:Question')->findAll();
        return $questions;
    }

    /**
     * get question by id
     *
     * @param $id
     * @return Question|null|object
     */
    public function findById($id)
    {
        $question = $this->entityManager->getRepository('AppBundle:Question')->find($id);
        return $question;
    }

    /**
     * find by surveyID, sort by published
     *
     * @param $surveyId
     * @return Question[]|array
     */
    public function findByPublished($surveyId)
    {
        $questions = $this->entityManager->getRepository('AppBundle:Question')->findBy(array('survey' => $surveyId),array('published' => 'DESC'));
        return $questions;
    }
}