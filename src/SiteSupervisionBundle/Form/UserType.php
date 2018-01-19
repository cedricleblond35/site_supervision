<?php

namespace SiteSupervisionBundle\Form;


use SiteSupervisionBundle\Entity\Employee;
use SiteSupervisionBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('email', EmailType::class, array(
                'required'   => true,
                'attr' => array('class' => 'form-control col-md-7 col-xs-12'),
                'label' => 'E-mail utilisateur',
                'required'   => true,
            ))
//            ->add('roles', ChoiceType::class, [
//                "choices_as_values" => true,
//                "choices" => [
//                    "Admin" => "ROLE_SUPER_ADMIN",
//                    "Entreprise" => "ROLE_USER_COMPANY_PRINCIPAL",
//                    "Client" => "ROLE_CUSTOMER"
//                ],
//                "multiple" => false,
//                "expanded" => true
//            ])
            ->add('password', RepeatedType::class, array(
                'invalid_message' => 'Les mots de passe ne sont pas identiques.',
                'options' => array('attr' => array('class' => 'form-control col-md-7 col-xs-12', 'data-validate-length-range' =>'5,20')),
                'required'   => true,
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Confirmation mot de passe')
            ))
            ->add('username', HiddenType::class, array('data' => '', 'label' => false));


        //ajouter les champs nécessaire selon le type d'utilisateur créé
        $builder->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) use ($options) {
            //$user = $event->getData();
            $form = $event->getForm();
            if ($options['block_name'] == 'customer') {
                $form->add('roles', HiddenType::class, array('data' => 'ROLE_CUSTOMER','label' => false));
            }
            if ($options['block_name'] == 'company') {
                $form->add('roles', HiddenType::class, array('data' => 'ROLE_USER_COMPANY','label' => false));
            }
        });
    }


    /**
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
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
