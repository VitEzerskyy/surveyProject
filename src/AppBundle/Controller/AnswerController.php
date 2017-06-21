<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Answer;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\ORMException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Debug\Exception\FatalThrowableError;
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
     * Receive post data and transfer it to command
     *
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/add", name="add_answer")
     */
    public function addAction(Request $request) {

        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);

        try{
            $this->get('app.question_write')->addAnswersToQuestions($parametersAsArray);
            $this->addFlash('success','Thank for your answers!');
        }catch(\Exception $e) {
            return $this->render('@App/Error/error.html.twig', array('error' => $e->getMessage()));
        }
        return new Response('OK');
    }

    /**
     * Receive $id from request and transfer gotten survey object to stats service
     *
     * @param Request $request
     * @param integer $id
     *
     * @return array
     *
     * @Template()
     * @Route("/stats/{id}", name="answer_stats")
     */
    public function statsAction(Request $request, $id) {

        $survey = $this->get('app.survey_read')->findById($id);
        $result = $this->get('app.stats')->getStats($survey);

        return ['result' => $result];
    }

}
