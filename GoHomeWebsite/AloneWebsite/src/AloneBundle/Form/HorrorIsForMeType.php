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
use AloneBundle\Enum\HorrorIsForMeAnswer;

class HorrorIsForMeType extends AbstractQuestion
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer',
            ChoiceType::class,
            array(
                'label' => 'Horror is for me:',
                'required' => false,
                'choices' => [
                    'Brutality / Gore' => HorrorIsForMeAnswer::BRUTALITY_GORE,
                    'Jumpscares' => HorrorIsForMeAnswer::JUMPSCARES,
                    'The unkown' => HorrorIsForMeAnswer::THE_UNKOWN,
                    'Loneliness' => HorrorIsForMeAnswer::LONELINESS,
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
            'data' => QuestionType::STEP_HORROR_FOR_ME,
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