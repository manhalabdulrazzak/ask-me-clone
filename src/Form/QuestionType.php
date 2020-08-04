<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Your question may not be blank.'
                    ]),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'Your question can only be {{ limit }} characters long.'
                    ])
                ]
            ])
            ->add('body', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'rows' => 5
                ],
                'label' => 'Body (Optional)'
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Ask Question"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
