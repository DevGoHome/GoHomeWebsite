<?php

namespace AloneBundle\Form;

use AloneBundle\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AbstractQuestion extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('optionalAnswer',
            TextareaType::class,
            array(
                'label' => 'Nothing from above: ',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'Write your own thoughts here!'
                )
            )
            )
            ->add('submit',
            SubmitType::class,
            array(
                'label' => 'Next Question!',
                'attr' => array(
                    'class' => 'button_text btn btn-block btn-outline-dark'
                )
            )
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}