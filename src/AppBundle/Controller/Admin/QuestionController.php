<?php
namespace AppBundle\Controller\Admin;
use AppBundle\Entity\Question;
use AppBundle\Form\QuestionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Route("/admin/question")
 */
class QuestionController extends Controller
{
    /**
     * @Template()
     * @Route("/create/{surveyId}", name="question_create")
     */
    public function createAction(Request $request, $surveyId)
    {
        $question = new Question();
        $survey = $this->get('app.survey_query')->findById($surveyId);

        if (!$survey) {
            $this->addFlash('fail', 'Survey not found');
            return $this->redirectToRoute('survey_show');
        }

        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.question_command')->save($question,$survey);
            $this->addFlash('success','The question has added!');
            return $this->redirectToRoute('question_show',array('surveyId' => $request->get('surveyId')));
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Template()
     * @Route("/show/{surveyId}", name="question_show")
     */
    public function showAction(Request $request, $surveyId) {
        $questions = $this->get('app.question_query')->findByPublished($surveyId);
        return ['questions' => $questions, 'survey' => $surveyId];
    }

    /**
     * @Template()
     * @Route("/edit/{surveyId}/{questionId}", name="question_edit")
     */
    public function editAction(Request $request)
    {
        $doctrine = $this->get('doctrine');
        $question = $doctrine->getRepository('AppBundle:Question')->find($request->get('questionId'));

        if(!$question) {
            $this->addFlash('fail','Item not found!');
            return $this->redirectToRoute('question_show',array('surveyId' => $request->get('surveyId')));
        }

        $originalChoices = new ArrayCollection();

        // Create an ArrayCollection of the current Choice objects in the database
        foreach ($question->getChoices() as $choice) {
            $originalChoices->add($choice);
        }

        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($originalChoices as $choice) {
                if (false === $question->getChoices()->contains($choice)) {
                    $choice->setQuestion(null);
                    $doctrine->getManager()->remove($choice);
                }
            }

            $doctrine->getManager()->persist($question);
            $doctrine->getManager()->flush();
            $this->addFlash('success','Successfully edited!');
            return $this->redirectToRoute('question_show',array('surveyId' => $request->get('surveyId')));
        }
        return ['form' => $form->createView()];
    }

    /**
     * @Route("/delete/{surveyId}/{questionId}", name="question_delete")
     */
    public function deleteAction(Request $request, $questionId)
    {
        $question = $this->get('app.question_query')->findById($questionId);

        if(!$question) {
            $this->addFlash('fail','Item not found!');
            return $this->redirectToRoute('question_show',array('surveyId' => $request->get('surveyId')));
        }
        $this->get('app.question_command')->remove($question);
        $this->addFlash('success','The question was deleted!');
        return $this->redirectToRoute('question_show',array('surveyId' => $request->get('surveyId')));
    }
}