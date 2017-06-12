<?php

namespace AppBundle\Entity\Service;

use AppBundle\Entity\Question;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\QueryRepository;

class QuestionQueryRepository implements QueryRepository
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAll()
    {
        $questions = $this->entityManager->getRepository('AppBundle:Question')->findAll();
        return $questions;
    }

    public function findById($id)
    {
        $question = $this->entityManager->getRepository('AppBundle:Question')->find($id);
        return $question;
    }

    public function findByPublished($surveyId)
    {
        $questions = $this->entityManager->getRepository('AppBundle:Question')->findBy(array('survey' => $surveyId),array('published' => 'DESC'));
        return $questions;
    }
}