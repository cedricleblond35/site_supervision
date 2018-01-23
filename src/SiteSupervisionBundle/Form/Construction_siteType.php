<?php

namespace SiteSupervisionBundle\Form;

use Symfony\Component\Form\AbstractType;
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
            ->add('adresse1')
            ->add('adresse2')
            ->add('nbrePieces')
            ->add('surfaceSol')
            ->add('surfaceHabitable')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('dateDebutPrevi')
            ->add('dateFinPrevi')
            ->add('lien_cctp')
            ->add('lien_plans')
            ->add('lien_devis')
            ->add('lots')
            ->add('city')
            ->add('customer');
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
        return 'SiteSupervisionBundle_construction_site';
    }


}
