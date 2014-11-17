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
use Ihsan\MalesBundle\Form\AbstractType;

class IndikatorType extends AbstractType
{
    const FORM_NAME = 'indikator';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parent', 'entity', array(
                'class' => $this->guesser->getEntityClass(),
                'property' => 'name',
                'empty_value' => 'form.select.empty',
                'label' => 'form.label.parent',
                'required' => false,
            ))
            ->add('code', 'text', array(
                'label' => 'form.label.code',
            ))
            ->add('name', 'text', array(
                'label' => 'form.label.name',
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