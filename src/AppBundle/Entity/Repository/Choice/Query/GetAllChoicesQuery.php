<?php

namespace AppBundle\Entity\Repository\Choice\Query;

use AppBundle\Entity\Query;
use AppBundle\Entity\Repository\Choice\ChoiceReadRepository;
use AppBundle\Entity\Question;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class GetAllQuery
 * @package AppBundle\Entity\Repository\Choice\Query
 */
class GetAllChoicesQuery implements Query
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
     * @return bool|ArrayCollection
     */
    public function execute(Question $question = null)
    {
       return $this->choiceRep->getAll($question);
    }
}