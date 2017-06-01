<?php

namespace AppBundle\Controller;

use AppBundle\Form\WishType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class WishController extends Controller
{
    /**
     * @Template()
     * @Route("/wishes", name="wishes_index")
     */
    public function indexAction(Request $request)
    {
        $wishes = $this->get('doctrine')->
        getRepository('AppBundle:Wish')->
        findBy(array(),array('created' => 'DESC'));

        $form = $this->createForm(WishType::class);
        $form->add('submit', SubmitType::class, array(
            'attr' => array('class' => 'btn btn-primary')));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $wish = $form->getData();
            $em = $this->get('doctrine')->getManager();

            $em->persist($wish);
            $em->flush();

            $this->addFlash('success','Congratulations! The wish has added!');
            return $this->redirectToRoute('wishes_index');
        }

        return ['form' => $form->createView(), 'wishes' => $wishes];

    }

    /**
     * @Template()
     * @Route("/wish-{id}.html", name="wish_item")
     */
    public function showAction(Request $request)
    {
        $id = $request->get('id');
        $wish = $this->get('doctrine')->
        getRepository('AppBundle:Wish')->
        find($id);

        return ['wish' => $wish];
    }

    /**
     * @Route("/wish/delete/{id}", name="wish_delete")
     * @param Request $request
     * @return Response
     */
    public function deleteAction(Request $request)
    {
        $doctrine = $this->get('doctrine');
        $wish = $doctrine->getRepository('AppBundle:Wish')->find($request->get('id'));

        if(!$wish) {
            $this->addFlash('fail','Item not found!');
            return $this->redirectToRoute('wishes_index');
        }

        $doctrine->getManager()->remove($wish);
        $doctrine->getManager()->flush();

        $this->addFlash('success','The wish was deleted!');
        return $this->redirectToRoute('wishes_index');
    }

    /**
     * @Template()
     * @Route("/wish/edit/{id}", name="wish_edit")
     * @param Request $request
     * @return Response|array
     */
    public function editAction(Request $request)
    {
        $doctrine = $this->get('doctrine');
        $wish = $doctrine->getRepository('AppBundle:Wish')->find($request->get('id'));

        if(!$wish) {
            $this->addFlash('fail','Item not found!');
            return $this->redirectToRoute('wishes_index');
        }

        $form = $this->createForm(WishType::class, $wish);
        $form->add('submit', SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           $doctrine->getManager()->persist($wish);
            $doctrine->getManager()->flush();
            $this->addFlash('success','Successfully edited!');
            return $this->redirectToRoute('wishes_index');
        }
        return ['form' => $form->createView()];
    }

}
