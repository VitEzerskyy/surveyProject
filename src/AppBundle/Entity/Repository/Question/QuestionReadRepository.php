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
     * @throws \Exception
     */
    public function getAll()
    {
        try {
            $questions = $this->entityManager->getRepository('AppBundle:Question')->findAll();
        }catch (\Exception $e) {
            throw new \Exception("Something went wrong. Can't fetch data from Question");
        }
        return $questions;
    }

    /**
     * get question by id
     *
     * @param $id
     * @return Question|null|object
     * @throws \Exception
     */
    public function findById($id)
    {
        try {
            $question = $this->entityManager->getRepository('AppBundle:Question')->find($id);
        }catch (\Exception $e) {
            throw new \Exception("Something went wrong. Can't fetch data from Question");
        }
        return $question;
    }

    /**
     * find by surveyID, sort by published
     *
     * @param $surveyId
     * @return Question[]|array
     * @throws \Exception
     */
    public function findByPublished($surveyId)
    {
        try {
            $questions = $this->entityManager->getRepository('AppBundle:Question')->findBy(array('survey' => $surveyId),array('published' => 'DESC'));
        }catch (\Exception $e) {
            throw new \Exception("Something went wrong. Can't fetch data from Question");
        }
        return $questions;
    }
}