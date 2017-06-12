<?php

namespace AppBundle\Entity\Service;

use AppBundle\Entity\Question;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\QueryRepository;

/**
 * Class QuestionQueryRepository
 * @package AppBundle\Entity\Service
 */
class QuestionQueryRepository implements QueryRepository
{
    private $entityManager;

    /**
     * QuestionQueryRepository constructor.
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