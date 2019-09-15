<?php

namespace AloneBundle\Form;

use AloneBundle\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use AloneBundle\Enum\QuestionType;
use AloneBundle\Enum\HorrorGamesShouldBeAnswer;

class HorrorGamesShouldBeType extends AbstractQuestion
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer',
            ChoiceType::class,
            array(
                'label' => 'For me, horrorgames should be:',
                'required' => false,
                'choices' => [
                    'Atmospheric / Oppressiv' => HorrorGamesShouldBeAnswer::ATMOSPHERIC,
                    'Fast paced / Full of action' => HorrorGamesShouldBeAnswer::FAST_PACED,
                    'Somewhat relaxing' => HorrorGamesShouldBeAnswer::SOMEWHAT_RELAXING,
                    'More fun' => HorrorGamesShouldBeAnswer::MORE_FUN,
                ],
                'expanded' => true,
                'multiple' => false,
                'choice_attr' => function($choice, $key, $value) {
                    return ['class' => ''];
                },
                'label_attr' => ['class' => 'checkbox-custom'],
            )
            )
        ->add('type',
        HiddenType::class,
        array(
            'data' => QuestionType::STEP_HORROR_GAMES_SHOULD_BE,
        )
        );

        parent::buildForm($builder, $options);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}