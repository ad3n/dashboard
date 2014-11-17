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
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class WilayahToCodeTransformer implements DataTransformerInterface
{
    public function transform($code)
    {
        return $code;
    }

    public function reverseTransform($wilayah)
    {
        if (! $wilayah instanceof Wilayah) {
            throw new TransformationFailedException('The value must be instance of AppBundle\\Entity\\Wilayah');
        }

        return $wilayah->getCodePropinsi();
    }
}