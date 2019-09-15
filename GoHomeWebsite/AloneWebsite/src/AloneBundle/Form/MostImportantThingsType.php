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
use AloneBundle\Enum\MostImportantThingsAnswer;

class MostImportantThingsType extends AbstractQuestion
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer',
            ChoiceType::class,
            array(
                'label' => 'The most important thing in horrorgames for me is:',
                'required' => false,
                'choices' => [
                    'Scary monsters / Scary scenery' => MostImportantThingsAnswer::SCARY_MONSTERS,
                    'An interesting, explorable world' => MostImportantThingsAnswer::INTERESTING_WORLD,
                    'A good story' => MostImportantThingsAnswer::GOOD_STORY,
                    'Good graphics' => MostImportantThingsAnswer::GOOD_GRAPHICS,
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
            'data' => QuestionType::STEP_MOST_IMPORTANT_THING,
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