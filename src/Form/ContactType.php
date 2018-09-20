<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('surname')
            ->add('email')
            ->add('phone')
            ->add('quality', ChoiceType::class, 
                array('choices' => array( 'Leader économique' => 'leader_economique', 
                                        'Centre de formation' => 'centre_formation', 
                                        'Pouvoir publics' => 'pouvoir_publics',
                                        'Association' => 'association',
                                        'Partenaire' => 'partenaire',
                                        'Témoignage' => 'temoignage'),
            ))
            ->add('description')
            ->add('logo', FileType::class, array(
                'label' => 'Votre avatar', 
                'data_class' => null,
                'required' => false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
