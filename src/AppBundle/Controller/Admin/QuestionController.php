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
    public function createAction(Request $request)
    {
        $question = new Question();
        $doctrine = $this->get('doctrine');
        $survey = $doctrine->getRepository('AppBundle:Survey')->find($request->get('surveyId'));

        if (!$survey) {
            $this->addFlash('fail', 'Survey not found');
            return $this->redirectToRoute('survey_show');
        }

        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question->setSurvey($survey);
            $doctrine->getManager()->persist($question);
            $doctrine->getManager()->flush();
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
        $questions = $this->get('doctrine')->
        getRepository('AppBundle:Question')->
        findBy(array('survey' => $surveyId),array('published' => 'DESC'));

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
    public function deleteAction(Request $request)
    {
        $doctrine = $this->get('doctrine');
        $question = $doctrine->getRepository('AppBundle:Question')->find($request->get('questionId'));

        if(!$question) {
            $this->addFlash('fail','Item not found!');
            return $this->redirectToRoute('question_show',array('surveyId' => $request->get('surveyId')));
        }

        $doctrine->getManager()->remove($question);
        $doctrine->getManager()->flush();

        $this->addFlash('success','The question was deleted!');
        return $this->redirectToRoute('question_show',array('surveyId' => $request->get('surveyId')));
    }
}