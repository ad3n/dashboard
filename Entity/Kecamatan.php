<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serialize;
use Ihsan\MalesBundle\Entity\AbstractEntity;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\KecamatanRepository")
 * @ORM\Table(name="kecamatan", indexes={@ORM\Index(name="search_idx", columns={"code"})})
 *
 * @Serialize\ExclusionPolicy("all")
 **/
class Kecamatan extends AbstractEntity
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
     * @ORM\ManyToOne(targetEntity="Kabupaten", inversedBy="kecamatan")
     * @ORM\JoinColumn(name="kabupaten_id", referencedColumnName="id")
     *
     * @Serialize\Expose
     **/
    protected $kabupaten;

    /**
     * @ORM\Column(name="code", type="string", length=6, unique=true)
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
     * @ORM\OneToMany(targetEntity="Kelurahan", mappedBy="kecamatan")
     **/
    protected $kelurahan;

    /**
     * @return string
     **/
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->kelurahan = new ArrayCollection();
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
     * @return Kecamatan
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
     * @return Kecamatan
     */
    public function setName($name)
    {
        $this->name = strtoupper($name);

        return $this;
    }

    /**
     * Set kabupaten
     *
     * @param Kabupaten $kabupaten
     * @return Kecamatan
     */
    public function setKabupaten(Kabupaten $kabupaten = null)
    {
        $this->kabupaten = $kabupaten;

        return $this;
    }

    /**
     * Get kabupaten
     *
     * @return Kabupaten
     */
    public function getKabupaten()
    {
        return $this->kabupaten;
    }

    /**
     * Add kelurahan
     *
     * @param Kelurahan $kelurahan
     * @return Kecamatan
     */
    public function addKelurahan(Kelurahan $kelurahan)
    {
        $this->kelurahan[] = $kelurahan;

        return $this;
    }

    /**
     * Remove kelurahan
     *
     * @param Kelurahan $kelurahan
     */
    public function removeKelurahan(Kelurahan $kelurahan)
    {
        $this->kelurahan->removeElement($kelurahan);
    }

    /**
     * Get kelurahan
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getKelurahan()
    {
        return $this->kelurahan;
    }
}
