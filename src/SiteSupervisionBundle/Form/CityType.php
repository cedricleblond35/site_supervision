<?php

namespace SiteSupervisionBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CityType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('villeCodePostal', NumberType::class, array(
                'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'5', 'pattern' => 'numeric'),
                'label' => 'Code postal',
                'mapped' => false,
            ))
            ->add('villeNom', TextType::class, array(
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12')))
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SiteSupervisionBundle\Entity\VillesFranceFree'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'SiteSupervisionBundle_villesfrancefree';
    }


}
