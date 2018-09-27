<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => 'Prénom'))
            ->add('surname', TextType::class, array('label' => 'Nom'))
            ->add('email', TextType::class, array('label' => 'Email'))
            ->add('phone', TextType::class, array('label' => 'Téléphone'))
            ->add('quality', ChoiceType::class, 
                array('choices' => array( 'Leader économique' => 'leader_economique', 
                                        'Centre de formation' => 'centre_formation', 
                                        'Pouvoirs publics' => 'pouvoirs_publics',
                                        'Association' => 'association',
                                        'Partenaire économique' => 'partenaire_economique'),
            ))
            ->add('description', TextareaType::class, array('label' => 'Description'))
            ->add('logo', FileType::class, array(
                'label' => 'Logo', 
                'data_class' => null,
                'required' => false,
                'empty_data' => "empty_logo"
                ))
        ;
    }

}
