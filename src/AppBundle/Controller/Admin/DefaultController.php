<?php
namespace AppBundle\Controller\Admin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Class DefaultController
 * @package AppBundle\Controller\Admin
 *
 * @Route("/admin")
 */
class DefaultController extends Controller
{
    /**
     * Default admin page
     *
     * @param Request $request
     *
     * @return array
     *
     * @Template()
     *
     * @Route("/", name="admin_homepage")
     */
    public function indexAction(Request $request)
    {
        return [];
    }
}