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
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Ihsan\MalesBundle\Guesser\BundleGuesserInterface;
use Ihsan\MalesBundle\Form\AbstractType;

class BlockType extends AbstractType
{
    const FORM_NAME = 'block';

    protected $container;

    public function __construct(ContainerInterface $container, BundleGuesserInterface $bundleGuesser)
    {
        $this->container = $container;
        parent::__construct($bundleGuesser);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('block_id', 'choice', array(
                'label' => 'form.label.block',
                'choice_list' => new ChoiceList($this->container->getParameter('app.block'), $this->container->getParameter('app.block'))
            ))
            ->add('status', 'checkbox', array(
                'label' => 'form.label.status',
                'required' => false,
                'data' => true
            ))
            ->add('chart', 'entity', array(
                'label' => 'form.label.chart',
                'class' => 'AppBundle\\Entity\\Chart',
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