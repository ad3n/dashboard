<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Form;

use Ihsan\MalesBundle\Form\AbstractFilter;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class IndikatorFilterType extends AbstractFilter
{
    const FORM_NAME = 'indikator_filter';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parent', 'entity', array(
                'class' => $this->guesser->getEntityClass(),
                'property' => 'name',
                'empty_value' => 'form.select.empty',
                'label' => 'form.label.parent',
                'attr' => array('title' => 'form.tooltip.parent'),
                'required' => false,
            ))
            ->add('code', 'text', array(
                'label' => 'form.label.code',
                'attr' => array('title' => 'form.tooltip.code'),
            ))
            ->add('name', 'text', array(
                'label' => 'form.label.name',
                'attr' => array('title' => 'form.tooltip.name'),
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => $this->guesser->getBundleAlias(),
            'intention'  => self::FORM_NAME,
        ));
    }

    public function getName()
    {
        return self::FORM_NAME;
    }
}