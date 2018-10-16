<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactMailController extends AbstractController
{
    // /**
    //  * @Route("/contact", name="contact_mail")
    //  */

    // public function contactForm (Request $request,\Swift_Mailer $mailer)
    // {
    //     {
    //         dump($request);
    //         return $this->render('contactPage.html.twig');
    //     }
        
    // }

        /**
    * @Route("/contact", name="contactPage")
    */
    public function showContactPage(Request $request, \Swift_Mailer $mailer)
    {
      

        $message = (new \Swift_Message())
        ->setSubject('Formulaire de contact')
        ->setFrom('badbou13000@gmail.com')
        ->setTo('badbou13000@gmail.com')
        ->setBody("");

        $mailer->send($message);

        return $this->render('contactPage.html.twig');
        }

}


