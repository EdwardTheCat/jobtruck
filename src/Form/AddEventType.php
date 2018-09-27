<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Events;
use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address')
            ->add('description')
            ->add('date')
            ->add('longitude')
            ->add('latitude')
            ->add('city')
            ->add('postalCode')
            ->add('complement1')
            ->add('complement2')
            ->add('contacts', EntityType::class, array(
                'class' => Contact::class,
                'multiple' => true,
                'choice_label' => 'displayName'
            ) )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Events::class,
        ]);
    }
}
