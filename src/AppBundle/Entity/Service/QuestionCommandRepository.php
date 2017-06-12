<?php

namespace AppBundle\Entity\Service;

use AppBundle\Entity\Question;
use AppBundle\Entity\Survey;
use AppBundle\Entity\Answer;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\CommandRepository;

/**
 * Class QuestionCommandRepository
 * @package AppBundle\Entity\Service
 */
class QuestionCommandRepository implements CommandRepository
{
    private $entityManager;

    /**
     * QuestionCommandRepository constructor.
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
     */
    public function save($object, Survey $survey = null)
    {
        if ($object instanceof Question) {
            if ($survey) {
                $object->setSurvey($survey);
            }
            $this->entityManager->persist($object);
            $this->entityManager->flush();
        }
    }

    /**
     * remove question from db
     *
     * @param $object
     */
    public function remove($object)
    {
        if ($object instanceof Question) {
            $this->entityManager->remove($object);
            $this->entityManager->flush();
        }
    }

    /**
     * add all answers to corresponding questions
     *
     * @param array $parametersAsArray
     */
    public function addAnswersToQuestions(Array $parametersAsArray)
    {
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
}