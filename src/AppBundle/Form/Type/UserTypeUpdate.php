<?php
/**
 * Created by PhpStorm.
 * User: KevinSup
 * Date: 02/06/2016
 * Time: 12:24
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserTypeUpdate extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'label' => false,
                'required' => true,
                'attr' => array(
                    'class' => 'input-rv',
                    'placeholder' => 'Pseudo',
                    'autocomplete' => 'off'
                )
            ))
            ->add('email', TextType::class, array(
                'label' => false,
                'required' => true,
                'attr' => array(
                    'class' => 'input-rv',
                    'placeholder' => 'E-Mail',
                    'autocomplete' => 'off'
                )
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