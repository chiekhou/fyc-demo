<?php

namespace App\Form;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('firstname', TextType::class, [
                'attr' => [
                    'autocomplete' => 'given-name',
                    'placeholder' => 'Prénom',
                    'class' => 'appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm',
                    'style' => 'border-top-right-radius: 0px;',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre prénom.',
                    ]),
                ],
                'label' => false,
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'autocomplete' => 'family-name',
                    'placeholder' => 'Nom',
                    'class' => 'appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm',
                    'style' => 'border-top-left-radius: 0px;margin-left: -1px;width: calc(100% + 1px);',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre nom.',
                    ]),
                ],
                'label' => false,
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'autocomplete' => 'username',
                    'placeholder' => 'Adresse e-mail',
                    'class' => 'appearance-none rounded-none border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une adresse e-mail.',
                    ]),
                ],
                'label' => false,
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => [
                    'attr' => [
                        'autocomplete' => 'new-password',
                    ],
                ],
                'first_options' => [
                    'attr' => [
                        'placeholder' => 'Mot de passe',
                        'class' => 'appearance-none rounded-none border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm',
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez entrer un mot de passe.',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Le mot de passe doit comporter au moins {{ limit }} caractères.',
                            'max' => 4096,
                        ]),
                    ],
                    'label' => false,
                ],
                'second_options' => [
                    'attr' => [
                        'placeholder' => 'Confirmer le mot de passe',
                        'class' => 'appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm',
                    ],
                    'label' => false,
                ],
                'invalid_message' => 'Les deux mots de passe ne sont pas identiques.',
                'mapped' => false,
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'attr' => [
                    'class' => 'h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500',
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devriez accepter notre politique de confidentialité.',
                    ]),
                ],
                'label' => false,
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
