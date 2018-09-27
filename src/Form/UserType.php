<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Contact;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

use Symfony\Component\Form\FormInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array('label' => 'Pseudo'))
            ->add('email')
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'required' => true
            ))
            ->add('avatar', FileType::class, array(
                'label' => 'Votre avatar', 
                'data_class' => null,
                'required' => false,
                'empty_data' => "empty_avatar"
                ))
            ->add('roles', ChoiceType::class, 
                array('choices' => array( 'Utilisateur' => 'ROLE_USER', 'Administrateur' => 'ROLE_ADMIN'),
                'multiple'=> true ) )
            ->add('contact', EntityType::class, array(
                'class' => Contact::class,
                'choice_label' => 'displayName',
            ) );
            
        ;

    }

}
