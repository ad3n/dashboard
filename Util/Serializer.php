<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Util;

use JMS\Serializer\Serializer as JMSSerializer;
use JMS\Serializer\SerializationContext;

class Serializer
{
    protected $serializer;

    public function __construct(JMSSerializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function serialize($data, $groups, $format)
    {
        return $this->serializer->serialize($data, $format, SerializationContext::create()->setGroups(array_merge(array('Default'), $groups)));
    }

    public function deserialize($data, $type, $format)
    {
        return $this->serializer->deserialize($data, $type, $format);
    }
}