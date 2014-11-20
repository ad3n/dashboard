<?php
/**
 * This file is part of Males Bundle
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Twig;

use Doctrine\Common\Persistence\ObjectManager;

class CodeToWilayahFunction extends \Twig_Extension
{
    protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('wilayah', array($this, 'toWilayah')),
        );
    }

    public function toWilayah($code, $scope, $parentCode = null)
    {
        $condition[sprintf('code%s', ucfirst($scope))] = $code;

        switch ($scope) {
            case 'kabupaten':
                $condition['codePropinsi'] = $parentCode;
                break;
            case 'kecamatan':
                $condition['codeKabupaten'] = $parentCode;
                break;
            case 'kelurahan':
                $condition['codeKecamatan'] = $parentCode;
                break;
        }

        return $this->objectManager->getRepository('AppBundle:Wilayah')->findOneBy($condition);
    }

    public function getName()
    {
        return 'wilayah';
    }
} 