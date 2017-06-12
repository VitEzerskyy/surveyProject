<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyController extends Controller
{
    /**
     * @Template()
     * @Route("/", name="surveys_all")
     */
    public function indexAction(Request $request)
    {
        $surveys = $this->get('app.survey_query')->findByCreated();
        return ['surveys' => $surveys];
    }

    /**
     * @Template()
     * @Route("/show/{id}", name="client_survey_show")
     */
    public function showAction(Request $request, $id) {

        $survey = $this->get('app.survey_query')->findById($id);
        return ['survey' => $survey];
    }

}
