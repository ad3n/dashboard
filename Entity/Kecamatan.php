<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serialize;
use Ihsan\MalesBundle\Entity\AbstractEntity;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\KecamatanRepository")
 * @ORM\Table(name="kecamatan")
 *
 * @Serialize\ExclusionPolicy("all")
 **/
class Kecamatan extends AbstractEntity
{
    protected $id;

    protected $kabupaten;

    protected $code;

    protected $name;

    protected $kelurahan;

    /**
     * @return string
     **/
    public function getName()
    {
        return $this->name;
    }
}