<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'form.contraints.field_not_valid'
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'form.constraints.field_limit',
                        'max' => 32
                    ])
                ],
                'label' => 'form.field.name',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('lastname', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'form.contraints.field_not_valid'
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'form.constraints.field_limit',
                        'max' => 32
                    ])
                ],
                'label' => 'form.field.lastname',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'form.contraints.email_not_valid'
                    ]),
                    new Email([
                        'message' => 'form.contraints.email_not_valid'
                    ])
                ],
                'label' => 'form.field.email',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'form.contraints.accept_terms',
                    ]),
                ],
                'attr' => [
                    'class' => 'form-check-input'
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'mapped' => false,
                'first_options' => [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'form.contraints.password_not_empty',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'form.constraints.password_limit',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096
                        ]),
                    ],
                    'label' => 'form.field.password',
                    'attr'  => [
                        'class' => 'form-control'
                    ]
                ],
                'second_options' => [
                    'label' => 'form.field.password_confirm',
                    'attr'  => [
                        'class' => 'form-control'
                    ]
                ],
                'invalid_message' => 'form.constraints.password_repeat'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
