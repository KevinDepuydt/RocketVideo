<?php

/**
 * Created by PhpStorm.
 * User: KevinSup
 * Date: 28/05/2016
 * Time: 14:58
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class StreamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('path', TextType::class, array(
                'label' => false,
                'attr' => array(
                    'class' => 'input-add-video',
                    'placeholder' => 'Coller le lien de la vidéo ici',
                    'autocomplete' => 'off'
                )
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Charger la vidéo',
                'attr' => array(
                    'class' => 'btn-rv btn-rv-default btn-add-video'
                )
            ))
        ;
    }
}