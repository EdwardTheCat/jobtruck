<?php

namespace App\Controller;

use App\Entity\Events;
use App\Form\AddEventType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventsController extends AbstractController
{

    /**
    * @Route("/admin/events/{id}", requirements={"id"="\d+"}, name="showEvent")
    */
    public function show($id){
        $event = $this->getDoctrine()
            ->getRepository(Events::class)
            ->findOneById($id);

        if (!$event) {
            throw $this->createNotFoundException(
                'Aucun événement trouvé pour '.$id
            );
        }

        return $this->render('events/showEvent.html.twig', [
            'id'   => $id,
            'event' => $event]);
    }

    /**
    * @Route("/admin/events", name="listEvents")
    */
     public function list(){

        $events = $this->getDoctrine()
            ->getRepository(Events::class)
            ->findAll();

        return $this->render('events/listEvents.html.twig', [
            'events' => $events
        ]);
    }

    /**
    * @Route("/admin/events/create", name="createEvent")
    * @Route("/admin/events/edit/{id}", requirements={"id"="\d+"}, name="editEvent")
    */
     public function create(Events $event = null, Request $request, ObjectManager $manager){
        if(is_null($event))
            $event = new Events();

        $form= $this->createForm(AddEventType::class, $event);
                        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $manager->persist($event);
            $manager->flush();
            return $this->redirectToRoute('listEvents');
        }

        return $this->render('events/create.html.twig', [
            'formEvent' => $form->createView(),
            'action' =>  is_null($event->getId())
        ]);
    }

    /**
    * @Route("admin/events/delete/{id}", name="deleteEvent" , requirements={"id"="\d+"})
    */
    public function delete(Events $event=null, ObjectManager $manager){
        
        if(!is_null($event)){
            $manager->remove($event);
            $manager->flush();
        }

        return $this->redirectToRoute('listEvents');
    }

    /**
    * @Route("admin/events/addOne/{id}", name="addOne", requirements={"id"="\d+"})
    */
    public function addOne(Events $event=null, ObjectManager $manager){
        
        //current user who is connected
        $currentUser = $this->getUser();
        dump($currentUser);

        if(!is_null($event)){
            //We add the current user in the event of the request
            $users=$event->getUsers();
            $users->add($currentUser);
            
            $manager->persist($event);
            $manager->flush();
           
        }

        return $this->redirectToRoute('listEvents');
    }

}
