<?php

namespace Pfe\Bundle\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EventFilter extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text' , array(
                'required' => false
            ))
            ->add('description', 'text' , array(
                'required' => false
            ))
            ->add('startDate', 'date', array(
                'required' => false,
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                )
            )
            ->add('endDate', 'date', array(
                'required' => false,
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                )
            )
            ->add('numberPlace', 'integer', array(
                'required' => false
            ))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfe_event_bundle_event_filter';
    }
}
