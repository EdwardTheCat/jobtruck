<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         //Creation de plusieurs utilisateurs
         for ($i=0; $i < 5 ; $i++) { 
            $contact = new \App\Entity\Contact($i);//on force car Contact fixture et Users entity ont les même noms
                $contact->setName("name".$i)
                        ->setSurname("surname".$i)
                        ->setEmail("mail".$i."@users.fr")
                        ->setPhone("060000000".$i)
                        ->setQuality("leader_economique")
                        ->setDescription("Bla Bla Bla")
                        ->setLogo("logo".$i);

            $manager->persist($contact);
        }

        $manager->flush();
    }
}
