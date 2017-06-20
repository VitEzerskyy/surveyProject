<?php

namespace AppBundle\Entity\Repository\Choice\Command;

use AppBundle\Entity\Command;
use AppBundle\Entity\Repository\Choice\ChoiceWriteRepository;
use AppBundle\Entity\Question;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Class EditCommand
 * @package AppBundle\Entity\Repository\Choice\Command
 */
class EditCommand implements Command
{
    protected $choiceRep;

    /**
     * EditCommand constructor.
     * @param ChoiceWriteRepository $repository
     */
    public function __construct(ChoiceWriteRepository $repository) {
        $this->choiceRep = $repository;
    }

    /**
     * @param ArrayCollection|null $choices
     * @param Question|null $question
     */
    public function execute(ArrayCollection $choices = null, Question $question = null)
    {
        $this->choiceRep->edit($choices, $question);
    }
}