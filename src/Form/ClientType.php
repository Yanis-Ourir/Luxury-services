<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('society_name', TextType::class, [
                'label' => 'Your society name'
            ])
            ->add('activity', TextType::class, [
                'label' => 'Your activity'
            ])
            ->add('contact_name', TextType::class, [
                'label' => 'Your name'
            ])
            ->add('post', TextType::class, [
                'label' => 'post'
            ])
            ->add('contact_number', TextType::class, [
                'label' => 'Contact number'
            ])
            ->add('contact_email', TextType::class, [
                'label' => 'email'
            ])
            ->add('notes', TextType::class, [
                'label' => 'notes'
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'waves-effect waves-light btn',

                ],
                'label' => 'New Client'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
