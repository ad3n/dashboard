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
use AppBundle\Validator\Constraints as AppAssert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\KelurahanRepository")
 * @ORM\Table(name="kelurahan", indexes={@ORM\Index(name="search_idx", columns={"code"})})
 *
 * @Serialize\ExclusionPolicy("all")
 *
 * @AppAssert\UniqueKelurahanCode
 **/
class Kelurahan extends AbstractEntity
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
     * @ORM\ManyToOne(targetEntity="Kecamatan", inversedBy="kelurahan")
     * @ORM\JoinColumn(name="kecamatan_id", referencedColumnName="id")
     *
     * @Serialize\Expose
     **/
    protected $kecamatan;

    /**
     * @ORM\Column(name="code", type="string", length=9, unique=true)
     *
     * @Serialize\Expose
     * @Assert\NotBlank
     **/
    protected $code;

    /**
     * @ORM\Column(name="name", type="string", length=77)
     *
     * @Serialize\Expose
     * @Assert\NotBlank
     **/
    protected $name;

    /**
     * @return string
     **/
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Kelurahan
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Kelurahan
     */
    public function setName($name)
    {
        $this->name = strtoupper($name);

        return $this;
    }

    /**
     * Set kecamatan
     *
     * @param Kecamatan $kecamatan
     * @return Kelurahan
     */
    public function setKecamatan(Kecamatan $kecamatan = null)
    {
        $this->kecamatan = $kecamatan;

        return $this;
    }

    /**
     * Get kecamatan
     *
     * @return Kecamatan
     */
    public function getKecamatan()
    {
        return $this->kecamatan;
    }
}
