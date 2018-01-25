<?php

namespace SiteSupervisionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('numero')->add('libelle')->add('description')->add('localisation')->add('lot');
            //->add('article');
        /*$builder
            ->add('numero', IntegerType::class, [
                "label" => "Numéro"
            ])
            ->add('libelle', null, array(
                'required'   => true
            ))
            ->add('description', TextareaType::class, array(
                "label" =>"Description",
                'required'   => false,
                'attr' => array('class' => 'tinymce'),
            ))
            ->add('localisation', null, array(
                "label" =>"Localisation",
                'required'   => false
            ))
            ->add('lot', EntityType::class, [
                "label" => "Lot",
                "class" => "SiteSupervisionBundle:Entity:Lot",
                "choice_label" => "libelle"])
            ->add('article', EntityType::class, [
                "label" => "Article",
                "class" => "SiteSupervisionBundle:Entity:Article",
                "choice_label" => "libelle"])
            ->add('submit', SubmitType::class, [
                "label" => "Enregistrer"
            ]);*/

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SiteSupervisionBundle\Entity\Article'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'SiteSupervisionBundle_article';
    }


}
