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

class IndikatorController extends CrudController
{
    public function __construct(ContainerInterface $container, AbstractType $formType, EntityInterface $entity)
    {
        parent::__construct($container, $formType, $entity);
    }
} 