<?php

namespace AppBundle\Entity\Service;

use AppBundle\Entity\Question;
use AppBundle\Entity\Survey;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\CommandRepository;

class QuestionCommandRepository implements CommandRepository
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save($object, Survey $survey = null)
    {
        if ($object instanceof Question) {
            $object->setSurvey($survey);
            $this->entityManager->persist($object);
            $this->entityManager->flush();
        }
    }

    public function remove($object)
    {
        if ($object instanceof Question) {
            $this->entityManager->remove($object);
            $this->entityManager->flush();
        }
    }
}