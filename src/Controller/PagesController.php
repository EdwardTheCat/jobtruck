<?php

namespace App\Controller;

use App\Repository\JobRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PagesController extends AbstractController
{

    /**
    * @Route("/acceuil", name="homePage")
    */
    public function showHomePage()
    {
        return $this->render('homePage.html.twig');
    }

    /**
    * @Route("/concept", name="conceptPage")
    */
    public function showConceptPage()
    {
        return $this->render('conceptPage.html.twig');
    }

    /**
    * @Route("/temoignages", name="testimonyPage")
    */
    public function showTestimonyPage(JobRepository $repo)
    {
        $allJob  =$repo->findAll();
        return $this->render('testimonyPage.html.twig', [
            'all' => $allJob    ]);
    }

    /**
    * @Route("/evenements", name="eventsPage")
    */
    public function showEventsPage()
    {
        return $this->render('eventsPage.html.twig');
    }

    /**
    * @Route("/jobs", name="jobsPage")
    */
    public function showJobsPage()
    {
        return $this->render('jobsPage.html.twig');
    }

    /**
    * @Route("/contact", name="contactPage")
    */
    public function showContactPage()
    {
        return $this->render('contactPage.html.twig');
    }

}
