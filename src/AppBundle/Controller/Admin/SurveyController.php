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

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->get('doctrine')->getManager();

            $em->persist($survey);
            $em->flush();

            $this->addFlash('success','The survey has added!');
            return $this->redirectToRoute('survey_show');
        }

        return ['form' => $form->createView()];
    }


    /**
     * @Template()
     * @Route("/show", name="survey_show")
     */
    public function showAction(Request $request) {
        $surveys = $this->get('doctrine')->
        getRepository('AppBundle:Survey')->
        findBy(array(),array('created' => 'DESC'));

        return ['surveys' => $surveys];
    }

    /**
     * @Route("/delete/{id}", name="survey_delete")
     */
    public function deleteAction(Request $request)
    {
        $doctrine = $this->get('doctrine');
        $survey = $doctrine->getRepository('AppBundle:Survey')->find($request->get('id'));

        if(!$survey) {
            $this->addFlash('fail','Item not found!');
            return $this->redirectToRoute('survey_show');
        }

        $doctrine->getManager()->remove($survey);
        $doctrine->getManager()->flush();

        $this->addFlash('success','The survey was deleted!');
        return $this->redirectToRoute('survey_show');
    }

    /**
     * @Template()
     * @Route("/edit/{id}", name="survey_edit")
     */
    public function editAction(Request $request)
    {
        $doctrine = $this->get('doctrine');
        $survey = $doctrine->getRepository('AppBundle:Survey')->find($request->get('id'));

        if(!$survey) {
            $this->addFlash('fail','Item not found!');
            return $this->redirectToRoute('survey_show');
        }

        $form = $this->createForm(SurveyType::class, $survey);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine->getManager()->persist($survey);
            $doctrine->getManager()->flush();
            $this->addFlash('success','Successfully edited!');
            return $this->redirectToRoute('survey_show');
        }
        return ['form' => $form->createView()];
    }
}