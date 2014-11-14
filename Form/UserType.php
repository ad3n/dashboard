<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Ihsan\MalesBundle\Form\AbstractType;
use Ihsan\MalesBundle\Guesser\BundleGuesserInterface;

class UserType extends AbstractType
{
    const FORM_NAME = 'user';

    protected $roleHierarchy;

    public function __construct(BundleGuesserInterface $guesser, array $roleHierarchy)
    {
        $this->roleHierarchy = array_keys($roleHierarchy);
        parent::__construct($guesser);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('full_name', 'text', array(
                'label' => 'form.label.full_name',
                'attr' => array('title' => 'form.tooltip.full_name'),
            ))
            ->add('username', 'text', array(
                'label' => 'form.label.username',
                'attr' => array('title' => 'form.tooltip.username'),
            ))
            ->add('email', 'email', array(
                'label' => 'form.label.email',
                'attr' => array('title' => 'form.tooltip.email'),
            ))
            ->add('password', 'password', array(
                'label' => 'form.label.password',
                'attr' => array('title' => 'form.tooltip.password'),
            ))
            ->add('roles', 'choice', array(
                'label' => 'form.label.role',
                'choice_list' => new ChoiceList($this->roleHierarchy, $this->roleHierarchy),
                'empty_value' => 'form.select.empty',
                'attr' => array('title' => 'form.tooltip.role'),
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->guesser->getEntityClass(),
            'translation_domain' => $this->guesser->getBundleAlias(),
            'intention'  => self::FORM_NAME,
        ));
    }

    public function getName()
    {
        return self::FORM_NAME;
    }
} 