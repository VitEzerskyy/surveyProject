<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Answer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AnswerController
 *
 * @package AppBundle\Controller
 *
 * @Route("/answer")
 */
class AnswerController extends Controller
{

    /**
     * Receive post data and transfer it to write repository
     *
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/add", name="add_answer")
     * @throws \Exception
     */
    public function addAction(Request $request) {

        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);
        if (empty($parametersAsArray)) {
            throw new \Exception("No data was received");
        }

        $this->get('app.question_write')->addAnswersToQuestions($parametersAsArray);
        $this->addFlash('success','Thank for your answers!');

        return new Response('OK');
    }

    /**
     * Receive $id from request and transfer gotten survey object to stats service
     *
     * @param Request $request
     * @param integer $id
     *
     * @return array|Response
     *
     * @Template()
     * @Route("/stats/{id}", name="answer_stats")
     */
    public function statsAction(Request $request, $id) {

        $survey = $this->get('app.survey_read')->findById($id);
        if (!$survey) {
            $this->addFlash('fail','Survey not found!');
            return $this->redirectToRoute('surveys_all');
        }
        $result = $this->get('app.stats')->getStats($survey);

        return ['result' => $result];
    }

}
