<?php

namespace SiteSupervisionBundle\Form;


use SiteSupervisionBundle\Entity\Lot;
use SiteSupervisionBundle\Repository\LotRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Construction_siteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adresse1', TextType::class,
                array(
                    'required'   => true,
                    'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                    'label' => 'Adresse 1'
                )
            )
            ->add('adresse2', TextType::class, 
                array(
                    'required'   => true,
                    'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                    'label' => 'Adresse 2'
                )
            )
            ->add('nbrePieces', NumberType::class,
                array(
                    'required'   => true,
                    'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                    'label' => 'Nombre de pièce',
                    'scale' => 0,
                    )
            )
            ->add('surfaceSol', NumberType::class, 
                array(
                    'required'   => true,
                    'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                    'label' => 'Surface au sol',
                    'scale' => 2,
                )
            )
            ->add('surfaceHabitable', NumberType::class,
                array(
                    'required'   => true,
                    'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                    'label' => 'Surface habitable',
                    'scale' => 2,
                )
            )
            ->add('dateDebut', BirthdayType::class, 
                array(
                    'required'   => true,
                    'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                    'label' => 'Début réel'
                )
            )
            ->add('dateFin', BirthdayType::class, 
                array(
                    'required'   => true,
                    'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                    'label' => 'Fin réel'
                )
            )
            ->add('dateDebutPrevi', BirthdayType::class, 
                array(
                    'required'   => true,
                    'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                    'label' => 'Début prévisionnel'
                )
            )
            ->add('dateFinPrevi', BirthdayType::class, 
                array(
                    'required'   => true,
                    'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                    'label' => 'Fin prévisionnel'
                )
            )
            ->add('lien_cctp', null, 
                array(
                    'required'   => true,
                    'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                    'label' => 'CCTP'
                )
            )
            ->add('lien_plans', null, 
                array(
                    'required'   => true,
                    'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                    'label' => 'Plans'
                )
            )
            ->add('lien_devis', null, 
                array(
                    'required'   => true,
                    'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                    'label' => 'Devis'
                )
            )
            ->add('lots', EntityType::class,
                array(
                    "label" => "Lots",
                    'attr' => array('class' => 'col-md-7 col-xs-12'),
                    "class" => Lot::class,
                    'multiple' => true,
                    'expanded' => true,
                    'query_builder' => function (LotRepository $repo) {
                        return $repo->createQueryBuilder('u')
                            ->orderBy('u.numero', 'ASC');
                    },
                )
            )

            ->add('villesFranceFree', CityType::class,
                [ 'block_name' => 'customer', 'label' => false]
            )
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SiteSupervisionBundle\Entity\Construction_site'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        //return 'SiteSupervisionBundle_customer';
        return null;
    }


}
