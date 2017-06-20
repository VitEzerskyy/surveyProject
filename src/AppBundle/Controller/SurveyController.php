<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SurveyController
 * @package AppBundle\Controller
 */
class SurveyController extends Controller
{
    /**
     * Returns all surveys for client
     *
     * @param Request $request
     *
     * @return array
     *
     * @Template()
     * @Route("/", name="surveys_all")
     */
    public function indexAction(Request $request)
    {
        $surveys = $this->get('app.survey_read')->findByCreated();
        return ['surveys' => $surveys];
    }

    /**
     * Returns survey by $id for client
     *
     * @param Request $request
     * @param integer $id
     *
     * @return array
     *
     * @Template()
     * @Route("/show/{id}", name="client_survey_show")
     */
    public function showAction(Request $request, $id) {

        $survey = $this->get('app.survey_read')->findById($id);
        return ['survey' => $survey];
    }

}
