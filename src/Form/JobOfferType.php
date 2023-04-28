<?php

namespace App\Form;

use App\Entity\JobOffer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints as Assert;

class JobOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('active', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No' => false
                ]
            ])
            ->add('notes', TextType::class)
            ->add('job_title', TextType::class, [
                'label' => 'Job name'
            ])
            ->add('job_category', ChoiceType::class, [
                'choices' => [
                    'option' => 'employment',
                ]
            ])
            ->add('closing_date', DateType::class, [
                'label' => 'When does this offer expire'
            ])
            ->add('salary', MoneyType::class, [
                'constraints' => [
                    new Assert\Positive()
                ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'waves-effect waves-light btn',

                ],
                'label' => 'Create'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JobOffer::class,
        ]);
    }
}
