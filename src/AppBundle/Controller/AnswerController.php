<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Answer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/answer")
 */
class AnswerController extends Controller
{

    /**
     * @Route("/add", name="add_answer")
     */
    public function addAction(Request $request) {

        $doctrine = $this->get('doctrine');

        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);


        foreach ($parametersAsArray as $value) {
            $answer = new Answer();
            $answer->setAnswer($value['answer']);

            $question = $doctrine->getRepository('AppBundle:Question')->findOneBy(array('id'=>$value['questionId']));
            $question->addAnswer($answer);

            $doctrine->getManager()->persist($question);
        }
        $doctrine->getManager()->flush();

        $this->addFlash('success','Thank for your answers!');
        return new Response('ok');
    }

    /**
     * @Template()
     * @Route("/stats/{id}", name="answer_stats")
     */
    public function statsAction(Request $request) {

        $survey = $this->get('doctrine')->
        getRepository('AppBundle:Survey')->
        findOneBy(array('id' => $request->get('id')));

        $result = $this->get('app.stats')->getStats($survey);


        return ['result' => $result];
    }

}
