<?php

namespace AppBundle\Entity\Service;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Survey;
use AppBundle\Entity\CommandRepository;


class SurveyCommandRepository implements CommandRepository
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save($object)
    {
        if ($object instanceof Survey) {
            $this->entityManager->persist($object);
            $this->entityManager->flush();
        }
    }

    public function remove($object)
    {
        if ($object instanceof Survey) {
            $this->entityManager->remove($object);
            $this->entityManager->flush();
        }
    }
}