<?php

namespace AppBundle\Entity\Repository\Question;

use AppBundle\Entity\Question;
use AppBundle\Entity\Survey;
use AppBundle\Entity\Answer;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\WriteRepository;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class QuestionWriteRepository
 * @package AppBundle\Entity\Repository
 */
class QuestionWriteRepository implements WriteRepository
{
    private $entityManager;

    /**
     * QuestionWriteRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * save question to db
     *
     * @param $object
     * @param Survey|null $survey
     * @throws \Exception
     */
    public function save($object, Survey $survey = null)
    {
        try {
            if ($object instanceof Question) {
                if ($survey) {
                $object->setSurvey($survey);
                }
                $this->entityManager->persist($object);
                $this->entityManager->flush();
            }
        }catch (\Exception $e) {
            throw new \Exception("Something went wrong. Can't save Question");
        }
    }

    /**
     * remove question from db
     *
     * @param $object
     * @throws \Exception
     */
    public function remove($object)
    {
        try {
            if ($object instanceof Question) {
                $this->entityManager->remove($object);
                $this->entityManager->flush();
            }
        }catch(\Exception $e) {
            throw new \Exception("Something went wrong. Can't remove Question");
        }
    }

    /**
     * add all answers to corresponding questions
     *
     * @param array $parametersAsArray
     * @throws \Exception
     */
    public function addAnswersToQuestions(Array $parametersAsArray)
    {
        try {
            if (!empty($parametersAsArray)) {
                foreach ($parametersAsArray as $value) {
                    $answer = new Answer();
                    $answer->setAnswer($value['answer']);

                    $question = $this->entityManager->getRepository('AppBundle:Question')
                        ->findOneBy(array('id'=>$value['questionId']));

                    $question->addAnswer($answer);
                    $this->entityManager->persist($question);
                }
                $this->entityManager->flush();
            }
        }catch(\Exception $e) {
            throw new \Exception("Something went wrong. Can't add answers to Question");
        }
    }
}