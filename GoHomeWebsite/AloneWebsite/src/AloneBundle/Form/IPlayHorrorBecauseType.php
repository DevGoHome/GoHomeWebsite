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
use AloneBundle\Enum\IPlayHorrorBecause;

class IPlayHorrorBecauseType extends AbstractQuestion
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer',
            ChoiceType::class,
            array(
                'label' => 'I play horrorgames because',
                'required' => false,
                'choices' => [
                    'I dont like horrorgames' => IPlayHorrorBecause::I_DONT_LIKE_HORROR,
                    'I like horror and scary things' => IPlayHorrorBecause::I_LIKE_HORROR_AND_SCARY_THINGS,
                    'I like the tension' => IPlayHorrorBecause::I_LIKE_THE_TENSION,
                    'They are fun when played with multiple people' => IPlayHorrorBecause::THEY_ARE_FUN,
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
            'data' => QuestionType::STEP_I_PLAY_HORROR_GAMES_BECAUSE,
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