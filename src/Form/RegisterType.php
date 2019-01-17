<?php

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => "Entrer un nom",
                'attr' => array(
                    'placeholder' => "Nom"
                )
            ))
            ->add('email', EmailType::class, array(
                'label' => "Entrer un email",
                'attr' => array(
                    'placeholder' => "Email"
                )
            ))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Les deux mot de passe ne sont pas identique.',
                'options' => array('attr' => array('class' => 'password-field',
                    'placeholder' => "Mot de passe"
                )),
                'required' => true,
                'first_options' => array('label' => 'Entrer un mot de passe'),
                'second_options' => array('label' => 'Répéter le mot de passe'),
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
            'translation_domain' => 'forms'
        ]);


    }
}
