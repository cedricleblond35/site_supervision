<?php

namespace SiteSupervisionBundle\Form;


use Doctrine\ORM\EntityManager;
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
                    'required'   => false,
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
                    'required'   => false,
                    'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                    'label' => 'Surface au sol',
                    'scale' => 2,
                )
            )
            ->add('surfaceHabitable', NumberType::class,
                array(
                    'required'   => false,
                    'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                    'label' => 'Surface habitable',
                    'scale' => 2,
                )
            )
            ->add('dateDebut', BirthdayType::class, 
                array(
                    'required'   => false,
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(),
                    'years' => range(date('Y') - 10, date('Y') +1),
                    'label' => 'Début réel'
                )
            )
            ->add('dateFin', BirthdayType::class, 
                array(
                    'required'   => false,
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(),
                    'years' => range(date('Y') - 10, date('Y') + 10),
                    'label' => 'Fin réel'
                )
            )
            ->add('dateDebutPrevi', BirthdayType::class, 
                array(
                    'required'   => false,
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(),
                    'years' => range(date('Y') - 10, date('Y') +1),
                    'label' => 'Début prévisionnel'
                )
            )
            ->add('dateFinPrevi', BirthdayType::class, 
                array(
                    'required'   => false,
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(),
                    'years' => range(date('Y') - 10, date('Y') + 10),
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
                    'attr' => array('class' => 'form-control col-md-7 col-xs-12 dropzone dz-clickable', 'data-validate-length-range' =>'3,20'),
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
                    "label" => false,
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
            ->add('villeCodePostal', NumberType::class, array(
                'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'5', 'pattern' => 'numeric'),
                'label' => 'Code postal',
                'mapped' => false,
            ))
            ->add('villesFranceFree',  EntityType::class, [
                "label" => "Ville",
                'mapped' => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12'),
                // query choices from this entity
                "class" => "SiteSupervisionBundle:VillesFranceFree",
                // use the User.username property as the visible option string
                "choice_label" => "villeNom",
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('u');
                },
            ])

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
