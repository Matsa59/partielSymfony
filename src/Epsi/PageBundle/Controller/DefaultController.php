<?php

namespace Epsi\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/page/{slug}", name="page")
     * @Template()
     */
    public function pageAction($slug)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $pageRepository = $em->getRepository('EpsiPageBundle:Page');

        $page = $pageRepository->findOneBy(array('slug' => $slug));

        if ($page === null) {
            return $this->redirect($this->generateUrl('homepage'));
        }

        return array('page' => $page);
    }
}
