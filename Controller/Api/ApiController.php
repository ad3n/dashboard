<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiController extends Controller
{
    protected function serialize($data, $groups = array(), $format = 'json')
    {
        $serializer = $this->container->get('app.util.serializer');

        return $serializer->serialize($data, $groups, $format);
    }

    protected function deserialize($data, $type, $format = 'json')
    {
        $serializer = $this->container->get('app.util.serializer');

        return $serializer->serialize($data, $type, $format);
    }

    protected function getEntityAlias($entityClassName = null)
    {
        return $this->container->get('males.guesser')->initialize($this, $entityClassName)->getEntityAlias();
    }
} 