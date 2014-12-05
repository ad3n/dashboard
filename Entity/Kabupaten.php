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
use AppBundle\Validator\Constraints as AppAssert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\KabupatenRepository")
 * @ORM\Table(name="kabupaten", indexes={@ORM\Index(name="search_idx", columns={"code"})})
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

    /**
     * @ORM\ManyToOne(targetEntity="Propinsi", inversedBy="kabupaten")
     * @ORM\JoinColumn(name="propinsi_id", referencedColumnName="id")
     *
     * @Serialize\Expose
     **/
    protected $propinsi;

    /**
     * @ORM\Column(name="code", type="string", length=4, unique=true)
     *
     * @Serialize\Expose
     * @Assert\NotBlank
     *
     * @AppAssert\UniqueKabupatenCode
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
     * @ORM\OneToMany(targetEntity="Kecamatan", mappedBy="kabupaten")
     **/
    protected $kecamatan;

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
        $this->kecamatan = new ArrayCollection();
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
     * @return Kabupaten
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
     * @return Kabupaten
     */
    public function setName($name)
    {
        $this->name = strtoupper($name);

        return $this;
    }

    /**
     * Set propinsi
     *
     * @param Propinsi $propinsi
     * @return Kabupaten
     */
    public function setPropinsi(Propinsi $propinsi = null)
    {
        $this->propinsi = $propinsi;

        return $this;
    }

    /**
     * Get propinsi
     *
     * @return Propinsi
     */
    public function getPropinsi()
    {
        return $this->propinsi;
    }

    /**
     * Add kecamatan
     *
     * @param Kecamatan $kecamatan
     * @return Kabupaten
     */
    public function addKecamatan(Kecamatan $kecamatan)
    {
        $this->kecamatan[] = $kecamatan;

        return $this;
    }

    /**
     * Remove kecamatan
     *
     * @param Kecamatan $kecamatan
     */
    public function removeKecamatan(Kecamatan $kecamatan)
    {
        $this->kecamatan->removeElement($kecamatan);
    }

    /**
     * Get kecamatan
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getKecamatan()
    {
        return $this->kecamatan;
    }
}
