<?php

namespace App\Controller;

use App\Repository\EventsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)

    {
        
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
        
    }   

    /**
    * @Route("admin/dashboard", name="admin")
    */
    public function admin(EventsRepository $repo){

       $events = $repo->findEventsAfter(new \DateTime());

        return $this->render('dashboard.html.twig', ["events" => $events]);
    
    }
    
}
