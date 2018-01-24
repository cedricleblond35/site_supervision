<?php

namespace SiteSupervisionBundle\Form;


use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CustomerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite',  ChoiceType::class, array(
                'attr' => array('class' => 'btn-group', 'data-toggle' => 'buttons'),
                'choices' => array('Mr' => 'Mr', 'Mme' => 'Mme'),
                'expanded' => TRUE,
                'multiple' => FALSE,
                'choice_label' => false,
            ))
            ->add('nom', TextType::class, array(
                'label' => 'Nom',
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
            ))
            ->add('prenom', TextType::class, array(
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
            ))
            ->add('telephonePortable', TextType::class, array(
                'attr'  => array('class' => 'form-control col-md-7 col-xs-12', 'data-inputmask' => '\'mask\' : \'99-99-99-99-99\''),
                'label' => 'Téléphone portable',
            ))
            ->add('telephoneFixe', TextType::class, array(
                'attr'  => array('class' => 'form-control col-md-7 col-xs-12', 'data-inputmask' => '\'mask\' : \'99-99-99-99-99\''),
                'label' => 'Téléphone fixe'
            ))
            ->add('pmr',  CheckboxType::class, array(
                'attr' => array('class' => 'btn-group', 'data-toggle' => 'buttons'),
                'label' => 'Aménagement PMR'
            ))
            ->add('dateNaissance',BirthdayType::class, array(
                'attr' => array(),
                'label' => 'Date de naissance',
            ))
            ->add('adresse1', null, array(
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'3,20'),
                'label' => 'Adresse 1',
            ))
            ->add('adresse2', null, array(
                'attr' => array('class' => 'form-control col-md-7 col-xs-12'),
                'label' => 'Adresse 2',
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
            ->add('note', TextareaType::class, array(
                'required'   => false,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12'),
                'label' => 'Notes',
            ))
        ->add('user', UserType::class, [ 'block_name' => 'customer', 'label' => false])
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
        //return 'SiteSupervisionBundle_customer';
        return null;
    }
    
    


}
