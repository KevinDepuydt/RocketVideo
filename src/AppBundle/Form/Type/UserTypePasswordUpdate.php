<?php
/**
 * Created by PhpStorm.
 * User: KevinSup
 * Date: 02/06/2016
 * Time: 13:17
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserTypePasswordUpdate extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('old_password', PasswordType::class, array(
                'label' => false,
                'required' => true,
                'mapped' => false,
                'attr' => array(
                    'class' => 'input-rv',
                    'placeholder' => 'Ancien mot de passe',
                    'autocomplete' => 'off'
                )
            ))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'required' => true,
                'invalid_message' => 'Les mots de passe ne correspondent pas',
                'first_options'  => array('label' => false, 'attr' => array(
                    'placeholder' => 'Nouveau mot de passe',
                    'class' => 'input-rv'
                )),
                'second_options' => array('label' => false, 'attr' => array(
                    'placeholder' => 'Vérification du mot de passe',
                    'class' => 'input-rv'
                ))
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Mettre à jour',
                'attr' => array(
                    'class' => 'btn-rv btn-rv-default'
                )
            ))
        ;
    }
}