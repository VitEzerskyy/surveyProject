<?php

namespace AppBundle\Entity\Service;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Survey;
use AppBundle\Entity\QueryRepository;

/**
 * Class SurveyQueryRepository
 * @package AppBundle\Entity\Service
 */
class SurveyQueryRepository implements QueryRepository
{
    private $entityManager;

    /**
     * SurveyQueryRepository constructor.
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
     */
    public function getAll()
    {
        $surveys = $this->entityManager->getRepository('AppBundle:Survey')->findAll();
        return $surveys;
    }

    /**
     * find survey by id
     *
     * @param $id
     * @return Survey|null|object
     */
    public function findById($id)
    {
        $survey = $this->entityManager->getRepository('AppBundle:Survey')->find($id);
        return $survey;
    }

    /**
     * find all surveys, sort by created
     *
     * @return Survey[]|array
     */
    public function findByCreated() {
        $surveys = $this->entityManager->getRepository('AppBundle:Survey')->findBy(array(),array('created' => 'DESC'));
        return $surveys;
    }
}