<?php

namespace App\Controller;

use App\Entity\Job;
use App\Repository\JobRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JobController extends AbstractController
{
    /**
     * @Route("/admin/job/create", name="createJob")
     * @Route("/admin/job/edit/{id}", name="editJob")
     */
    public function createJob(Job $job=null, Request $request, ObjectManager $manager )
    {
        if (is_null($job))
            $job = new Job();

        $formJob = $this->createFormBuilder($job)
                        ->add('title',TextType::class)
                        ->add('description',TextType::class)
                        ->add('contact',EmailType::class)
                        ->add('logo')
                        ->add('validity')
                        ->add('enregister', SubmitType::class, array('label' => 'creation')) 
        ->getForm();

        $formJob->handleRequest($request);
        if ($formJob->isSubmitted() && $formJob->isValid()) {
            $job->setCreatedAT(new \DateTime());

            $manager->persist($job);
            $manager->flush();
       
            return $this->redirectToRoute('listJob');
        }
        return $this->render('job/job.html.twig',[
            'form' => $formJob->createView(),
        ]);

    }


    /**
     * @Route("/admin/job/listJob", name="listJob")
     */
    public function listJob(JobRepository $repo)
    {
        $allJob  =$repo->findAll();
        return $this->render('job/listJob.html.twig',[

            'all'  => $allJob
        ]);
    }

    /**
    * @Route("admin/job/delete/{id}", name="deleteJob")
    */ 
    public function delete(ObjectManager $manager, Job $job) {
        $manager->remove($job);
        $manager->flush();
        return $this->redirectToRoute("listJob");  
    }

}
