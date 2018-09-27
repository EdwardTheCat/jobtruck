<?php

namespace App\Controller;

use App\Entity\Events;
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
        $events = $this->getDoctrine()
            ->getRepository(Events::class)
            ->findAll();
        return $this->render('eventsPage.html.twig', [
            'events' => $events
        ]);
    }

    /**
    * @Route("/jobs", name="jobsPage")
    */
    public function showJobsPage()
    {
        return $this->render('jobsPage.html.twig');
    }

}
