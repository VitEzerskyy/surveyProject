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

        $surveys = $this->get('doctrine')->getRepository('AppBundle:Survey')->findBy(array(),array('created' => 'DESC'));

        return ['surveys' => $surveys];
    }

    /**
     * @Template()
     * @Route("/show/{id}", name="client_survey_show")
     */
    public function showAction(Request $request) {

        $survey = $this->get('doctrine')->
        getRepository('AppBundle:Survey')->
        findOneBy(array('id' => $request->get('id')));

        return ['survey' => $survey];
    }

}
