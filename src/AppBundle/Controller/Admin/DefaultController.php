<?php
namespace AppBundle\Controller\Admin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * @Route("/admin")
 */
class DefaultController extends Controller
{
    /**
     * @Template()
     * @Route("/", name="admin_homepage")
     */
    public function indexAction(Request $request)
    {
        return [];
    }
}