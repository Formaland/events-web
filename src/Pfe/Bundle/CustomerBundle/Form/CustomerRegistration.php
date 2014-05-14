<?php

namespace Pfe\Bundle\CustomerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CustomerRegistration extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', 'text', array(
                'label' => 'customer.first_name',
                'translation_domain' => 'PfeCustomerBundle',
            ))
            ->add('last_name', 'text', array(
                'label' => 'customer.last_name',
                'translation_domain' => 'PfeCustomerBundle',
            ))
            ->add('civility', 'choice', array(
                'label' => 'customer.civility',
                'choices' => array(
                    'mr' => 'customer.civilitys.mr',
                    'mmd' => 'customer.civilitys.mmd',
                    'mlle' => 'customer.civilitys.mlle',
                ),
                'translation_domain' => 'PfeCustomerBundle',
            ))
            ->add('birth_date', 'birthday', array(
                'label' => 'customer.birth_date',
                'translation_domain' => 'PfeCustomerBundle',
            ))
            ->add('address', 'text', array(
                'label' => 'customer.address',
                'translation_domain' => 'PfeCustomerBundle',
            ))
            ->add('postal_code', 'text', array(
                'label' => 'customer.postal_code',
                'translation_domain' => 'PfeCustomerBundle',
            ))
            ->add('city', 'text', array(
                'label' => 'customer.city',
                'translation_domain' => 'PfeCustomerBundle',
            ))
            ->add('country', 'country', array(
                'label' => 'customer.country',
                'translation_domain' => 'PfeCustomerBundle',
            ))
            ->add('email', 'email', array(
                'label' => 'customer.email',
                'translation_domain' => 'PfeCustomerBundle',
            ))
            ->add('phone_number', 'integer', array(
                'label' => 'customer.phone_number',
                'translation_domain' => 'PfeCustomerBundle',
            ))
            ->add('username', 'text', array(
                'label' => 'customer.username',
                'translation_domain' => 'PfeCustomerBundle',
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'invalid password',
                'options' => array('required' => true),
                'first_options'  => array('label' => 'customer.password'),
                'second_options' => array('label' => 'customer.password_confirmation'),
                'translation_domain' => 'PfeCustomerBundle',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfe\Bundle\CustomerBundle\Entity\Customer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfe_customer_registration';
    }
}
