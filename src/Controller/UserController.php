<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends AbstractController
{
     /**
     * @Route("admin/user/{id}", name="userDetails" , requirements={"id"="\d+"})
     */
    public function details(UserRepository $repo, $id)
    {   
        $user=$repo->findOneById($id);
        return $this->render('user/userDetails.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user
        ]);
    }

    /**
      * 
     * @Route("admin/user/list", name="userList")
     */
    public function list(UserRepository $repo){

        $users=$repo->findAll();

        return $this->render('user/userList.html.twig', ["users" => $users]);

    }


/**
     * @Route("admin/user/add", name="userAdd")
     * @Route("admin/user/edit/{id}", name="userEdit" , requirements={"id"="\d+"})
     */
    public function add(User $user=null, Request $request, ObjectManager $manager, UserPasswordEncoderInterface $passwordEncoder)
    {
        // creates a task and gives it some dummy data for this example
        if(is_null($user)) {
            $user = new User();
        }
            $form = $this->createForm(UserType::class, $user);

            //todo find an easy way to rename the field required at true
            if(is_null($user->getId())){
                $form->remove('plainPassword')
                     ->add('plainPassword', RepeatedType::class, array(
                        'type' => PasswordType::class,
                        'first_options'  => array('label' => 'Password'),
                        'second_options' => array('label' => 'Repeat Password'),
                        'required' => true
                     ));
            }

            //We get the user connected note used      
            //$connectedUser=$this->getUser();
           
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {
                
                    // $file stores the uploaded PDF file
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                
                $file = $form->get('avatar')->getData();
                if(is_null($file))
                    $user->setAvatar('avatar_base.png');
                else
                {
                    $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

                    // moves the file to the directory where brochures are stored
                    $file->move(
                        $this->getParameter('avatar_directory'),
                        $fileName
                    );
                    // updates the 'user' property to store the PDF file name
                    // instead of its contents
                    $user->setAvatar($fileName);
                }

                $user->setCreatedAt(new \DateTime());
        
                //we encode the password
                //if password from the form != null we encode the new pasword
                if($form->get('plainPassword')->getData()!=null){
                    $password = $passwordEncoder->encodePassword($user, $form->get('plainPassword')->getData());

                    $user->setPassword($password);
                }                                  

                //empty_data //closure

                //set user active
                $user->setIsActive(true);
                //$user->eraseCredentials();
                
                dump($user);

                //save user
                $manager->persist($user);
                $manager->flush();
                
                
                return $this->redirectToRoute('userList');
        
            }
            
         
        
        return $this->render('user/userAdd.html.twig', [
            'controller_name' => 'UserController',
            'form' => $form->createView(),
            'action' => is_null($user->getId()),
            'user' => $user
            ]
        );
    }



     /**
     * @Route("admin/user/delete/{id}", name="userDelete" , requirements={"id"="\d+"})
     */
    public function delete(User $user=null, ObjectManager $manager)
    {
        //vérification à faire sur le user avec id
        if(!is_null($user)){
            $manager->remove($user);
            $manager->flush();
        }

        return $this->redirectToRoute('userList');
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

}
