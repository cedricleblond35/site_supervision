<?php

namespace SiteSupervisionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',  TextType::class, array(
                'label' => 'Nom',
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
            ))
            ->add('prenom',  TextType::class, array(
                'label' => 'Prénom',
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
            ))
            ->add('telephonePortable', TextType::class, array(
                'attr'  => array('class' => 'form-control col-md-7 col-xs-12', 'data-inputmask' => '\'mask\' : \'99-99-99-99-99\''),
                'label' => 'Téléphone'
            ))

            ->add('user', UserType::class, [ 'block_name' => 'company', 'label' => false]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SiteSupervisionBundle\Entity\Employee'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'SiteSupervisionBundle_employee';
    }


}
