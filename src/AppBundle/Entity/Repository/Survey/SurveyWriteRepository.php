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
     * @throws \Exception
     */
    public function save($object)
    {
        try {
            if ($object instanceof Survey) {
                $this->entityManager->persist($object);
                $this->entityManager->flush();
            }
        } catch (\Exception $e) {
            throw new \Exception("Something went wrong. Can't save Survey");
        }
    }

    /**
     * remove survey from db
     *
     * @param $object
     * @throws \Exception
     */
    public function remove($object)
    {
        try {
            if ($object instanceof Survey) {
                $this->entityManager->remove($object);
                $this->entityManager->flush();
            }
        } catch (\Exception $e) {
            throw new \Exception("Something went wrong. Can't remove Survey");
        }
    }
}