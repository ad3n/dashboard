<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Ihsan\MalesBundle\Controller\CrudController;
use Ihsan\MalesBundle\Form\AbstractType;
use Ihsan\MalesBundle\Entity\EntityInterface;
use Ihsan\MalesBundle\Form\AbstractFilter;

class IndikatorController extends CrudController
{
    public function __construct(ContainerInterface $container, AbstractType $formType, AbstractFilter $formFilter, EntityInterface $entity)
    {
        parent::__construct($container, $formType, $formFilter, $entity);
    }
} 