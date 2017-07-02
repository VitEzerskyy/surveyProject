<?php
namespace AppBundle\Controller\Admin;
use AppBundle\Entity\Survey;
use AppBundle\Form\SurveyType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Class SurveyController
 * @package AppBundle\Controller\Admin
 *
 * @Route("/admin/survey")
 */
class SurveyController extends Controller
{
    /**
     * Return form for creating survey, transfer data to command
     *
     * @param Request $request
     *
     * @return array|Response
     *
     * @Template()
     * @Route("/create", name="survey_create")
     */
    public function createAction(Request $request)
    {
        $survey = new Survey();

        $form = $this->createForm(SurveyType::class, $survey);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.survey_write')->save($survey);
            $this->addFlash('success','The survey has added!');
            return $this->redirectToRoute('survey_show');
        }

        return ['form' => $form->createView()];
    }

    /**
     * Return all surveys
     *
     * @param Request $request
     *
     * @return array
     *
     * @Template()
     * @Route("/show", name="survey_show")
     */
    public function showAction(Request $request) {
        $surveys = $this->get('app.survey_read')->findByCreated();
        return ['surveys' => $surveys];
    }

    /**
     * Transfer data for deleting survey
     *
     * @param Request $request
     * @param integer $id
     *
     * @return array|Response
     *
     * @Route("/delete/{id}", name="survey_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        $survey = $this->get('app.survey_read')->findById($id);

        if(!$survey) {
            $this->addFlash('fail','Item not found!');
            return $this->redirectToRoute('survey_show');
        }

        $this->get('app.survey_write')->remove($survey);
        $this->addFlash('success','The survey was deleted!');

        return $this->redirectToRoute('survey_show');
    }

    /**
     * Return form for Editing survey, transfer data to command
     *
     * @param Request $request
     * @param integer $id
     *
     * @return array|Response
     *
     * @Template()
     * @Route("/edit/{id}", name="survey_edit")
     */
    public function editAction(Request $request, $id)
    {
        $survey = $this->get('app.survey_read')->findById($id);

        if(!$survey) {
            $this->addFlash('fail','Survey not found!');
            return $this->redirectToRoute('survey_show');
        }

        $form = $this->createForm(SurveyType::class, $survey);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.survey_write')->save($survey);
            $this->addFlash('success','Successfully edited!');
            return $this->redirectToRoute('survey_show');
        }
        return ['form' => $form->createView()];
    }
}