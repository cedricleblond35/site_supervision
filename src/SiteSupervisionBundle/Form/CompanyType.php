<?php

namespace SiteSupervisionBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Class CompanyType
 * @package SiteSupervisionBundle\Form
 *
 * http://symfony.com/doc/2.8/reference/forms/types/collection.html#allow-add
 * https://openclassrooms.com/courses/developpez-votre-site-web-avec-le-framework-symfony2/creer-des-formulaires-avec-symfony2
 * https://fostermade.co/blog/transient-models-in-symfony-forms
 */

class CompanyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',  TextType::class, array(
                'label' => 'Nom de la société',
                'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                'required'   => true,
            ))
            ->add('adresse1', null, array(
                'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                'label' => 'Adresse 1',
                'required'   => true,
            ))
            ->add('adresse2', null, array(
                'attr' => array('class' => 'form-control col-md-7 col-xs-12'),
                'label' => 'Adresse 2',
                'required'   => false,
            ))
            ->add('telephonefixe', TextType::class, array(
                'attr'  => array('class' => 'form-control col-md-7 col-xs-12', 'data-inputmask' => '\'mask\' : \'99-99-99-99-99\''),
                'label' => 'Téléphone fixe',
                'required'   => false,
            ))
            ->add('email', EmailType::class, array(
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12'),
                'label' => 'E-mail',
                'required'   => false,
            ))
            ->add('siret',  TextType::class, array(
                'label' => 'Code APE',
                'required'   => false,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'14'),
            ))
            ->add('ape',  TextType::class, array(
                'label' => 'Code APE',
                'required'   => false,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'5'),
            ))
            ->add('commentaire', TextareaType::class, array(
                'attr' => array('class' => 'form-control col-md-7 col-xs-12'),
                'label' => 'Notes',
                'required'   => false,
            ))
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
            ->add('employees', CollectionType::class,
                [
                    'entry_type' => EmployeeType::class,
                    'entry_options' => [],
                    //allow_add : Si la valeur est true, alors si des éléments non reconnus sont soumis à la collection, ils seront ajoutés en tant que nouveaux éléments. Le tableau de fin contiendra les éléments existants ainsi que le nouvel élément qui était dans les données soumises. Voir l'exemple ci-dessus pour plus de détails.
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'prototype'    => true,
                    'required'     => false,
                    'delete_empty' => true,
                    'by_reference' => false
                ]
            );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SiteSupervisionBundle\Entity\Company'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'SiteSupervisionBundle_company';
    }
}
