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
 * @ORM\Entity(repositoryClass="AppBundle\Entity\KelurahanRepository")
 * @ORM\Table(name="kelurahan")
 *
 * @Serialize\ExclusionPolicy("all")
 **/
class Kelurahan extends AbstractEntity
{
    protected $id;

    protected $kecamatan;

    protected $code;

    protected $name;

    /**
     * @return string
     **/
    public function getName()
    {
        return $this->name;
    }
}