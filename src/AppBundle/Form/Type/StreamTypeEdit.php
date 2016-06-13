<?php
/**
 * Created by PhpStorm.
 * User: KevinSup
 * Date: 13/06/2016
 * Time: 13:41
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class StreamTypeEdit extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => "Nom de la vidéo",
                'attr' => array(
                    'class' => 'input-add-video',
                    'placeholder' => 'Changer le nom de la vidéo',
                    'autocomplete' => 'off'
                )
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Valider',
                'attr' => array(
                    'class' => 'btn-rv btn-rv-default btn-add-video'
                )
            ))
        ;
    }
}