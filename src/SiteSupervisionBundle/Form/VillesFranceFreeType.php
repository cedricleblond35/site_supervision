<?php

namespace SiteSupervisionBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VillesFranceFreeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('villeDepartement', TextType::class, array(
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12'),
                ))
            ->add('villeNom', TextType::class, array(
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12')))
            ->add('villeNomReel', TextType::class, array(
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12')))
            ->add('villeCodePostal', NumberType::class, array(
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12','label' => 'Code postal',)))
            ->add('villeCodeCommune', NumberType::class, array(
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12')))
            ->add('villeArrondissement', NumberType::class, array(
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12')))
            ->add('villeLongitudeDeg')
            ->add('villeLatitudeDeg')->add('villeLongitudeGrd')->add('villeLatitudeGrd')->add('villeLongitudeDms')->add('villeLatitudeDms');
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
