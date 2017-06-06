<?php

namespace AppBundle\Form;

use AppBundle\Entity\Choice;
use AppBundle\Entity\Survey;
use AppBundle\Form\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class QuestionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->
        add('question', null, array('label' => null))->
        add('published');

        $builder->add('choices', CollectionType::class, array(
            'entry_type' => ChoiceType::class,
            'allow_add'    => true,
            'allow_delete' => true,
            'label' => false,
            'by_reference' => false
        ));

        $builder->add('submit', SubmitType::class, array(
            'attr' => array('class' => 'btn btn-primary')));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Question'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_question';
    }

}
