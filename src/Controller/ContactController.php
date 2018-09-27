<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("admin/contact/{id}", name="contactDetails" , requirements={"id"="\d+"})
     */
    public function details(ContactRepository $repo, $id)
    {   
        $contact=$repo->findOneById($id);
        return $this->render('contact/contactDetails.html.twig', [
            'contact' => $contact
        ]);
    }

    /**
     * 
     * @Route("admin/contact/list", name="contactList")
     */
    public function list(ContactRepository $repo){

        $contacts=$repo->findAll();

        return $this->render('contact/contactList.html.twig', ["contacts" => $contacts]);

    }

    /**
     * @Route("admin/contact/add", name="contactAdd")
     * @Route("admin/contact/edit/{id}", name="contactEdit" , requirements={"id"="\d+"})
     */
    public function add(Contact $contact=null, Request $request, ObjectManager $manager, UserPasswordEncoderInterface $passwordEncoder)
    {
        // creates a task and gives it some dummy data for this example
        if(is_null($contact)) {
            $contact = new Contact();
        }
            //get the route to update the user on edit, form empty value for avatar 
            $route=$request->get('_route');    
            $oldfilename="";
            if($route=="contactEdit"){
                $oldfilename=$contact->getLogo();
            }

            $form = $this->createForm(ContactType::class, $contact);

            //We get the user connected note used      
            //$connectedUser=$this->getUser();
           
            $form->handleRequest($request);
            $logoSaved="";

            // //we get the route
            // $currentRoute = $request->attributes->get('_route');
            // dump($currentRoute);
            // if($currentRoute=="contactEdit"){
            //     $form->remove('logo');
            // }
          
            
            if ($form->isSubmitted() && $form->isValid()) {
                
                dump($contact);
            
                // $file stores the uploaded PDF file
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                
                $file = $form->get('logo')->getData();

                if(is_null($file) or $file=="empty_logo"){
                    if($route=="contactEdit") { $contact->setLogo($oldfilename);}
                    else{$contact->setLogo('avatar_base.png');}
                }
                else{
                    $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

                    // moves the file to the directory where brochures are stored
                    $file->move(
                        $this->getParameter('logo_directory'),
                        $fileName
                    );
                    // updates the 'user' property to store the PDF file name
                    // instead of its contents
                    $contact->setLogo($fileName);
                }
                // else{
                //     if(!is_null($logoSaved)){
                //         $contact->setLogo($logoSaved);
                //     }
                //     //Use a default logo
                //     else{}
                    
                // }
                $contact->setCreatedAt(new \DateTime());
    
                //we encode the password
                //if password from the form != null we encode the new pasword
                
                //save user
                $manager->persist($contact);
                $manager->flush();
                
                
                return $this->redirectToRoute('contactList');
        
            }
            
         
            dump($contact);
            
            return $this->render('contact/contactAdd.html.twig', [
                'form' => $form->createView(),
                'action' => is_null($contact->getId()),
                'contact' => $contact
                ]
            );
    }



     /**
     * @Route("admin/contact/delete/{id}", name="contactDelete" , requirements={"id"="\d+"})
     */
    public function delete(Contact $contact=null, ObjectManager $manager)
    {
        //vérification à faire sur le user avec id
        if(!is_null($contact)){
            /* $manager->remove($contact->getUser()); */
            $manager->remove($contact);
            $manager->flush();
        }

        return $this->redirectToRoute('contactList');
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }


    /**
     * @Route("admin/whitness/list", name="witnessList")
     */
    public function witnessList(ContactRepository $repo)
    {   
        $contacts=$repo->findBy(["quality" => "temoignage"]);

        return $this->render('contact/contactList.html.twig', ["contacts" => $contacts]);
    }

    /**
     * @Route("admin/partners/list", name="partnersList")
     */
    public function partnersList(ContactRepository $repo)
    {   
        $contacts=$repo->findBy(["quality" => "partenaire"]);

        return $this->render('contact/contactList.html.twig', ["contacts" => $contacts]);
    }
}
