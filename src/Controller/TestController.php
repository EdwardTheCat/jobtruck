<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index()
    {
        /* return $this->render('testBase.html.twig'); */
        return $this->render('testPageConcept.html.twig');
    }

    /**
    * @Route("/test/concept", name="conceptPage")
    */
    public function showConceptPage()
    {
        return $this->render('conceptPage.html.twig');
    }

    /**
    * @Route("/test/temoignages", name="testimonyPage")
    */
    public function showTestimonyPage()
    {
        return $this->render('testimonyPage.html.twig');
    }

}
