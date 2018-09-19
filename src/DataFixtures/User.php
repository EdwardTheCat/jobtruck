<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class User extends Fixture
{
    public function load(ObjectManager $manager)
    {
         //Creation de plusieurs utilisateurs
         for ($i=0; $i < 5 ; $i++) { 
            $user = new \App\Entity\User($i);//on force car Users fixture et Users entity ont les même noms
            $user ->setUsername("username".$i)
                ->setEmail("mail".$i."@users.fr")
                ->setPassword("pass".$i)
                ->setAvatar("avatar".$i)
                ->setRoles(array("ROLE_ADMIN"))
                ->setCreatedAt(new \DateTime());
                
                //create contact
                $contact=new \App\Entity\Contact();
                $contact->setName("name".$i)
                        ->setSurname("surname".$i)
                        ->setEmail("mail".$i."@users.fr")
                        ->setPhone("060000000".$i)
                        ->setQuality("leader_economique")
                        ->setDescription("Bla Bla Bla");

                $user->setContact($contact);


            $manager->persist($user);
        }
        $manager->flush();

    }
}
