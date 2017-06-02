<?php
namespace AppBundle\Controller\Admin;
use AppBundle\Entity\Survey;
use AppBundle\Form\SurveyType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
/**
 * @Route("/admin/survey")
 */
class SurveyController extends Controller
{
    /**
     * @Template()
     * @Route("/create", name="survey_create")
     */
    public function createAction(Request $request)
    {
        $survey = new Survey();

        $form = $this->createForm(SurveyType::class, $survey);
        $form->add('submit', SubmitType::class, array(
            'attr' => array('class' => 'btn btn-primary')));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->get('doctrine')->getManager();

            $em->persist($survey);
            $em->flush();

            $this->addFlash('success','The survey has added!');
            return $this->redirectToRoute('survey_create');
        }

        return ['form' => $form->createView()];
    }
}