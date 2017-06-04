<?php
namespace AppBundle\Controller\Admin;
use AppBundle\Entity\Question;
use AppBundle\Form\QuestionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
//        for ($i = 0; $i < $request->get('number'); $i ++) {
//            $question[] = new Question();
//        }
//
//        $form = $this->createFormBuilder(array('questions' => $question));
//
//        $form->add('questions', CollectionType::class, array(
//                'entry_type' => QuestionType::class,
//                'label' => false,
//                'required' => false
//            )
//        );
//
//        if ($question) {
//            $form->add('submit', SubmitType::class, array(
//                'attr' => array('class' => 'btn btn-primary')));
//        }
//
//        $result = $form->getForm()->handleRequest($request);

        $form = $this->createForm(QuestionType::class, $question);
        $form->add('submit', SubmitType::class, array(
            'attr' => array('class' => 'btn btn-primary')));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $papa = $form->getData();
//
//            foreach($papa['questions'] as $value) {
//               $value->setSurvey($survey);
//               $doctrine->getManager()->persist($value);
//            }
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
}