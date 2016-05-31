<?php
/**
 * Created by PhpStorm.
 * User: KevinSup
 * Date: 28/05/2016
 * Time: 18:56
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserTypeLogin extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'label' => false,
                'attr' => array(
                    'class' => 'input-rv',
                    'placeholder' => 'Nom d\'utilisateur',
                    'autocomplete' => 'off',
                    'name' => '_username'
                )
            ))
            ->add('password', PasswordType::class, array(
                'label' => false,
                'attr' => array(
                    'class' => 'input-rv',
                    'placeholder' => 'Mot de passe',
                    'autocomplete' => 'off',
                    'name' => '_password'
                )
            ))
            ->add('valid', SubmitType::class, array(
                'label' => 'Connexion',
                'attr' => array(
                    'class' => 'btn-rv btn-rv-default'
                )
            ))
        ;
    }
}