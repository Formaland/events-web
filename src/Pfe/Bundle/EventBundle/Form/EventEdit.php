<?php

namespace Pfe\Bundle\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventEdit extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('translations', 'a2lix_translations')
            ->add('price')
            ->add('image', 'file', array(
                'required' => false
            ))
            ->add('address')
            ->add('categories', 'entity', array(
                'class' => 'PfeEventBundle:Category',
                'property' => 'id',
                'multiple' => true
            ))
            ->add('country' , 'country', array(
                'preferred_choices' => array('TN'),
            ))
            ->add('city')
            ->add('startDate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                )
            )
            ->add('endDate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                )
            )
            ->add('postalCode')
            ->add('numberPlace')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfe\Bundle\EventBundle\Entity\Event'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfe_bundle_eventbundle_eventedit';
    }
}
