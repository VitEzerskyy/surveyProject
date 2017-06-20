<?php

namespace AppBundle\Entity\Repository\Choice\Query;

use AppBundle\Entity\Query;
use AppBundle\Entity\Repository\Choice\ChoiceReadRepository;
use AppBundle\Entity\Question;

/**
 * Class GetAllQuery
 * @package AppBundle\Entity\Repository\Choice\Query
 */
class GetAllQuery implements Query
{
    protected $choiceRep;

    /**
     * EditCommand constructor.
     * @param ChoiceReadRepository $repository
     */
    public function __construct(ChoiceReadRepository $repository) {
        $this->choiceRep = $repository;
    }

    /**
     * @param Question|null $question
     */
    public function execute(Question $question = null)
    {
        $this->choiceRep->getAll($question);
    }
}