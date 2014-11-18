<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Wilayah;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class WilayahToCodeTransformer implements DataTransformerInterface
{
    protected $objectManager;

    protected $entity;

    protected $scope;

    public function __construct(ObjectManager $objectManager, $entity, $scope)
    {
        $this->objectManager = $objectManager;
        $this->entity = $entity;
        $this->scope = $scope;
    }

    public function transform($code)
    {
        if (null === $code) {
            return $code;
        }

        $wilayah = $this->objectManager->getRepository($this->entity)->findOneBy(array(sprintf('code%s', ucfirst($this->scope)) => $code));

        if (! $wilayah) {
            throw new TransformationFailedException(sprintf('Data with code %s not found.', $code));
        }

        return $wilayah;
    }

    public function reverseTransform($wilayah)
    {
        if (! $wilayah instanceof Wilayah) {
            throw new TransformationFailedException('The value must be instance of AppBundle\\Entity\\Wilayah');
        }

        return $wilayah->getCodePropinsi();
    }
}