<?php

namespace AppBundle\Entity\Repository\Survey;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Survey;
use AppBundle\Entity\WriteRepository;

/**
 * Class SurveyWriteRepository
 * @package AppBundle\Entity\Repository
 */
class SurveyWriteRepository implements WriteRepository
{
    private $entityManager;

    /**
     * SurveyWriteRepository constructor.
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