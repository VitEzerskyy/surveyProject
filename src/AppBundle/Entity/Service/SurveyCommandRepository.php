<?php

namespace AppBundle\Entity\Service;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Survey;
use AppBundle\Entity\CommandRepository;

/**
 * Class SurveyCommandRepository
 * @package AppBundle\Entity\Service
 */
class SurveyCommandRepository implements CommandRepository
{
    private $entityManager;

    /**
     * SurveyCommandRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * save survey to db
     *
     * @param $object
     */
    public function save($object)
    {
        if ($object instanceof Survey) {
            $this->entityManager->persist($object);
            $this->entityManager->flush();
        }
    }

    /**
     * remove survey from db
     *
     * @param $object
     */
    public function remove($object)
    {
        if ($object instanceof Survey) {
            $this->entityManager->remove($object);
            $this->entityManager->flush();
        }
    }
}