<?php

namespace App\Controller;

use App\Entity\Events;
use App\Repository\JobRepository;
use App\Repository\EventsRepository;
use App\Repository\ContactRepository;
use App\Repository\TestimonyRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PagesController extends AbstractController
{

    /**
    * @Route("/", name="homePage")
    */
    public function showHomePage(ContactRepository $contactRepo, TestimonyRepository $testimonyRepo, EventsRepository $eventsRepo)
    {
        $event=$eventsRepo->findEventsAfter(new \Datetime());

        $testimonies=$testimonyRepo->findAll();
        $partners=$contactRepo->findBy(["quality" => "partenaire"]);

        return $this->render('homePage.html.twig', [
            'testimonies' => $testimonies,
            'partners' => $partners,
            'event' => $event
        ]);
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
    public function showTestimonyPage(ContactRepository $contactRepo, JobRepository $jobRepo)
    {
        $contacts=$contactRepo->findBy(["quality" => "temoignage"]);
        $jobs  =$jobRepo->findAll();

        return $this->render('testimonyPage.html.twig', [
            'contacts' => $contacts,
               'jobs' => $jobs
        ]);
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
    public function showJobsPage(JobRepository $jobRepo, ContactRepository $contactRepo)
    {
        $jobs  =$jobRepo->findAll();
        $partners=$contactRepo->findBy(["quality" => "partenaire_economique"]);

        return $this->render('jobsPage.html.twig', [
            'jobs' => $jobs,
            'partners' => $partners
        ]);
    }

}
