<?php
namespace AppBundle\Controller\Admin;
use AppBundle\Entity\Question;
use AppBundle\Entity\Repository\Choice\ChoiceReadRepository;
use AppBundle\Form\QuestionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Class QuestionController
 * @package AppBundle\Controller\Admin
 *
 * @Route("/admin/question")
 */
class QuestionController extends Controller
{
    /**
     * Returns form for Creating question and its choices, transfer data to command
     *
     * @param Request $request
     * @param integer $surveyId
     *
     * @return array|Response
     *
     * @Template()
     *
     * @Route("/create/{surveyId}", name="question_create")
     */
    public function createAction(Request $request, $surveyId)
    {
        $question = new Question();
        $survey = $this->get('app.survey_read')->findById($surveyId);

        if (!$survey) {
            $this->addFlash('fail', 'Survey not found');
            return $this->redirectToRoute('survey_show');
        }

        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.question_write')->save($question,$survey);
            $this->addFlash('success','The question has added!');
            return $this->redirectToRoute('question_show',array('surveyId' => $request->get('surveyId')));
        }

        return ['form' => $form->createView()];
    }

    /**
     * Returns all questions for $surveyId survey
     *
     * @param Request $request
     * @param integer $surveyId
     *
     * @return array|Response
     *
     * @Template()
     * @Route("/show/{surveyId}", name="question_show")
     */
    public function showAction(Request $request, $surveyId) {
        $questions = $this->get('app.question_read')->findByPublished($surveyId);
        if (!$questions) {
            $this->addFlash('fail','Survey not found!');
            return $this->redirectToRoute('survey_show');
        }
        return ['questions' => $questions, 'survey' => $surveyId];
    }

    /**
     * Returns form for Editing question and its choices, transfer data to command
     *
     * @param Request $request
     * @param integer $questionId
     *
     * @return array|Response
     *
     * @Template()
     * @Route("/edit/{surveyId}/{questionId}", name="question_edit")
     */
    public function editAction(Request $request, $questionId)
    {
        $question = $this->get('app.question_read')->findById($questionId);

        if(!$question) {
            $this->addFlash('fail','Item not found!');
            return $this->redirectToRoute('question_show',array('surveyId' => $request->get('surveyId')));
        }

        /**Get an ArrayCollection of the current Choice objects in the database */
        $originalChoices = $this->get('app.choice_getall_query')->execute($question);

        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question = $this->get('app.choice_edit_command')->execute($originalChoices, $question);
            $this->get('app.question_write')->save($question);
            $this->addFlash('success','Successfully edited!');
            return $this->redirectToRoute('question_show',array('surveyId' => $request->get('surveyId')));
        }
        return ['form' => $form->createView()];
    }

    /**
     * Transfer data for Deleting question
     *
     * @param Request $request
     * @param integer $questionId
     *
     * @return Response
     *
     * @Route("/delete/{surveyId}/{questionId}", name="question_delete")
     */
    public function deleteAction(Request $request, $questionId)
    {
        $question = $this->get('app.question_read')->findById($questionId);

        if(!$question) {
            $this->addFlash('fail','Item not found!');
            return $this->redirectToRoute('question_show',array('surveyId' => $request->get('surveyId')));
        }
        $this->get('app.question_write')->remove($question);
        $this->addFlash('success','The question was deleted!');
        return $this->redirectToRoute('question_show',array('surveyId' => $request->get('surveyId')));
    }
}