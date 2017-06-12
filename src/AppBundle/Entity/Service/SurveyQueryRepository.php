<?php

namespace AppBundle\Entity\Service;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Survey;
use AppBundle\Entity\QueryRepository;

class SurveyQueryRepository implements QueryRepository
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAll()
    {
        $surveys = $this->entityManager->getRepository('AppBundle:Survey')->findAll();
        return $surveys;
    }

    public function findById($id)
    {
        $survey = $this->entityManager->getRepository('AppBundle:Survey')->find($id);
        return $survey;
    }

    public function findByCreated() {
        $surveys = $this->entityManager->getRepository('AppBundle:Survey')->findBy(array(),array('created' => 'DESC'));
        return $surveys;
    }
}