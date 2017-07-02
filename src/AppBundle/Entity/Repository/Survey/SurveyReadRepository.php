<?php

namespace AppBundle\Entity\Repository\Survey;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Survey;
use AppBundle\Entity\ReadRepository;

/**
 * Class SurveyReadRepository
 * @package AppBundle\Entity\Repository
 */
class SurveyReadRepository implements ReadRepository
{
    private $entityManager;

    /**
     * SurveyReadRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * get all surveys
     *
     * @return Survey[]|array
     * @throws \Exception
     */
    public function getAll()
    {
        try {
            $surveys = $this->entityManager->getRepository('AppBundle:Survey')->findAll();
        }catch (\Exception $e) {
            throw new \Exception("Oops! Something went wrong. Can't fetch data from Survey");
        }
        return $surveys;
    }

    /**
     * find survey by id
     *
     * @param $id
     * @return Survey
     * @throws \Exception
     */
    public function findById($id)
    {
        try {
            $survey = $this->entityManager->getRepository('AppBundle:Survey')->find($id);
        }catch (\Exception $e) {
            throw new \Exception("Oops! Something went wrong. Can't fetch data from Survey");
        }
        return $survey;
    }

    /**
     * find all surveys, sort by created
     *
     * @return Survey[]|array
     * @throws \Exception
     */
    public function findByCreated() {

        try {
            $surveys = $this->entityManager->getRepository('AppBundle:Survey')->findBy(array(),array('created' => 'DESC'));
        }catch (\Exception $e) {
            throw new \Exception("Oops! Something went wrong. Can't fetch data from Survey");
        }
        return $surveys;
    }
}