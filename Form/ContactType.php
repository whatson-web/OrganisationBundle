<?php

namespace WH\OrganisationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contactType', 'entity', array(
                    'class'    => 'WHOrganisationBundle:ContactType',
                    'property' => 'name',
                    'multiple' => false,
                    'expanded' => false,
                    'label'    => 'Type : '
                ))
            ->add('name', 'text', array('required' => false, 'attr' => array('placeholder' => 'nom')))
            ->add('value', 'text', array('attr' => array('placeholder' => 'valeur')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'APP\OrganisationBundle\Entity\Contact'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wh_organisationbundle_contact';
    }
}
