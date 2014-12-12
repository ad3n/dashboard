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

    public function __construct($entityClass, $repositoryMethod)
    {
        $this->entityClass = $entityClass;
        $this->repositoryMethod = $repositoryMethod;
    }

    public function getEntityClass()
    {
        return $this->entityClass;
    }

    public function getRepositoryMethod()
    {
        return $this->repositoryMethod;
    }
} 