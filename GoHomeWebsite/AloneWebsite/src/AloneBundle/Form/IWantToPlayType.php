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
use AloneBundle\Enum\IWantToPlayAnswer;

class IWantToPlayType extends AbstractQuestion
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer',
            ChoiceType::class,
            array(
                'label' => 'I want to play an horrorgame where:',
                'required' => false,
                'choices' => [
                    'I can fight the monsters' => IWantToPlayAnswer::I_FIGHT,
                    'I can uncover an interesting story' => IWantToPlayAnswer::I_CAN_UNCOVER_THE_STORY,
                    'I can explore the map' => IWantToPlayAnswer::I_CAN_EXPLORE,
                    'I feel the horror' => IWantToPlayAnswer::I_FEEL_HORROR,
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
            'data' => QuestionType::STEP_I_WANT_TO_PLAY_WHERE,
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