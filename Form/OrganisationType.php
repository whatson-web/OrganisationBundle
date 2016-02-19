<?php

namespace WH\OrganisationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrganisationType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('socialReason', 'text', array('required' => false, 'label' => 'Raison sociale : '))
            ->add('firstname', 'text', array('required' => false, 'label' => 'prénom : '))
            ->add('lastname', 'text', array('required' => false, 'label' => 'nom : '))
            ->add('phone', 'text', array('required' => false, 'label' => 'Téléphone : '))
            ->add('email', 'email', array('label' => 'Email : '))
            ->add('adress', 'text', array('label' => 'Adresse : ', 'required' => false))
            ->add('adressCplt', 'text', array('required' => false, 'label' => 'Adresse Cplt : '))
            ->add('zipCode', 'text', array('label' => 'Code postal : ', 'required' => false))
            ->add('town', 'text', array('label' => 'Ville : ', 'required' => false))

        ;

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'APP\OrganisationBundle\Entity\Organisation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wh_organisationbundle_organisation';
    }



}
