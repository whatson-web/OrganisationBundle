<?php

namespace WH\OrganisationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('attr' => array('placeholder' => 'Nom')))
            ->add('adress', 'text', array('required' => false, 'attr' => array('placeholder' => 'Adresse')))
            ->add('adressCplt', 'text', array('required' => false, 'attr' => array('placeholder' => 'Complément d’adresse')))
            ->add('zipCode', 'text', array('required' => false, 'attr' => array('placeholder' => 'Code postal')))
            ->add('town', 'text', array('required' => false, 'attr' => array('placeholder' => 'Ville')))
            ->add('country', 'country', array('required' => false, 'attr' => array('placeholder' => 'Pays')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'APP\OrganisationBundle\Entity\Adress'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wh_organisationbundle_adress';
    }
}
