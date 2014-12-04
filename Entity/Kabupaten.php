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
 * @ORM\Entity(repositoryClass="AppBundle\Entity\KabupatenRepository")
 * @ORM\Table(name="kabupaten")
 *
 * @Serialize\ExclusionPolicy("all")
 **/
class Kabupaten extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serialize\Expose
     **/
    protected $id;

    protected $propinsi;

    protected $code;

    protected $name;

    protected $kecamatan;

    /**
     * @return string
     **/
    public function getName()
    {
        return $this->name;
    }
}