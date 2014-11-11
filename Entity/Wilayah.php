<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serialize;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\WilayahRepository")
 * @ORM\Table(name="wilayah")
 *
 * @Serialize\ExclusionPolicy("all")
 **/
class Wilayah
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serialize\Expose
     **/
    protected $id;

    /**
     * @ORM\Column(name="code_propinsi", type="string", length=2)
     *
     * @Serialize\Expose
     **/
    protected $codePropinsi;

    /**
     * @ORM\Column(name="code_kabupaten", type="string", length=2)
     *
     * @Serialize\Expose
     **/
    protected $codeKabupaten;

    /**
     * @ORM\Column(name="code_kecamatan", type="string", length=2)
     *
     * @Serialize\Expose
     **/
    protected $codeKecamatan;

    /**
     * @ORM\Column(name="code_kelurahan", type="string", length=4)
     *
     * @Serialize\Expose
     **/
    protected $codeKelurahan;

    /**
     * @ORM\Column(name="name", type="string", length=33)
     *
     * @Serialize\Expose
     **/
    protected $name;

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setCodePropinsi($codePropinsi)
    {
        $this->codePropinsi = $codePropinsi;

        return $this;
    }

    public function getCodePropinsi()
    {
        return $this->codePropinsi;
    }

    public function setCodeKabupaten($codeKabupaten)
    {
        $this->codeKabupaten = $codeKabupaten;

        return $this;
    }

    public function getCodeKabupaten()
    {
        return $this->codeKabupaten;
    }

    public function setCodeKecamatan($codeKecamatan)
    {
        $this->codeKecamatan = $codeKecamatan;

        return $this;
    }

    public function getCodeKecamatan()
    {
        return $this->codeKecamatan;
    }

    public function setCodeKelurahan($codeKelurahan)
    {
        $this->codeKelurahan = $codeKelurahan;

        return $this;
    }

    public function getCodeKelurahan()
    {
        return $this->codeKelurahan;
    }
}
