<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
