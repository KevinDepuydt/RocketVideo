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
            ->add('password', PasswordType::class, array(
                'label' => false,
                'attr' => array(
                    'class' => 'input-rv',
                    'placeholder' => 'Mot de passe',
                    'autocomplete' => 'off'
                )
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