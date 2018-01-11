<?php

namespace SiteSupervisionBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CustomerType2 extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, array(
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
            ))
            ->add('prenom', null, array(
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
            ))
            ->add('telephonePortable', NumberType::class, array(
                'attr'  => array('class' => 'form-control col-md-7 col-xs-12', 'data-inputmask' => '\'mask\' : \'99-99-99-99-99\''),
                'label' => 'Téléphone portable',
            ))
            ->add('telephoneFixe', NumberType::class, array(
                'attr'  => array('class' => 'form-control col-md-7 col-xs-12', 'data-inputmask' => '\'mask\' : \'99-99-99-99-99\''),
                'label' => 'Téléphone fixe'
            ))
            ->add('email', EmailType::class, array(
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12'),
                'label' => 'E-mail',
            ))
            ->add('dateNaissance',BirthdayType::class, array(
                'attr' => array(),
                'label' => 'Date de naissance',
            ))

            ->add('adresse1', null, array(
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                'label' => 'adresse 1',
            ))
            ->add('adresse2', null, array(
                'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                'label' => 'Adresse 2',
            ))
            ->add('VillesFranceFree',  EntityType::class, array(
                "label" => "code postal",
                "class" => "SiteSupervisionBundle:VillesFranceFree",
                'choice_label' => 'villeNom',
                "multiple" => false,
                "expanded" => false,
            ))
//            ->add('city',  EntityType::class, [
//                "label" => "Ville",
//                // query choices from this entity
//                "class" => "SiteSupervisionBundle:VillesFranceFree",
//                // use the User.username property as the visible option string
//                "choice_label" => "villeNom",
//                "multiple" => true,
//                "expanded" => false,
//                ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SiteSupervisionBundle\Entity\Customer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'SiteSupervisionBundle_customer';
    }


}
