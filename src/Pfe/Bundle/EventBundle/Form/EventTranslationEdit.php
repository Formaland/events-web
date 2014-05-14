<?php

namespace Pfe\Bundle\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventTranslationEdit extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder            ->add('title')            ->add('description')            ->add('address')            ->add('city')            ->add('locale')            ->add('translatable')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfe\Bundle\EventBundle\Entity\EventTranslation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfe_bundle_eventbundle_eventtranslationedit';
    }
}
