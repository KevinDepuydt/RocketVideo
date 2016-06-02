<?php
/**
 * Created by PhpStorm.
 * User: KevinSup
 * Date: 28/05/2016
 * Time: 17:22
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserTypeRegistration extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'label' => false,
                'attr' => array(
                    'class' => 'input-rv',
                    'placeholder' => 'Pseudo',
                    'autocomplete' => 'off'
                )
            ))
            ->add('email', TextType::class, array(
                'label' => false,
                'attr' => array(
                    'class' => 'input-rv',
                    'placeholder' => 'E-Mail',
                    'autocomplete' => 'off'
                )
            ))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne correspondent pas',
                'required' => true,
                'first_options'  => array('label' => false, 'attr' => array(
                    'placeholder' => 'Mot de passe',
                    'class' => 'input-rv'
                )),
                'second_options' => array('label' => false, 'attr' => array(
                    'placeholder' => 'Vérification du mot de passe',
                    'class' => 'input-rv'
                ))
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Inscription',
                'attr' => array(
                    'class' => 'btn-rv btn-rv-default'
                )
            ))
        ;
    }
}