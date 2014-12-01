<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Util;

class QueryMapper
{
    private $entityClass;

    private $repositoryMethod;

    private $options;

    public function __construct($entityClass, $repositoryMethod, array $options = array())
    {
        $this->entityClass = $entityClass;
        $this->repositoryMethod = $repositoryMethod;
        $this->options = $options;
    }

    public function getEntityClass()
    {
        return $this->entityClass;
    }

    public function getRepositoryMethod()
    {
        return $this->repositoryMethod;
    }

    public function getOptions()
    {
        return $this->options;
    }
} 