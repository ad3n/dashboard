<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Entity;

use AppBundle\Validator\CodableInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serialize;
use Ihsan\MalesBundle\Entity\AbstractEntity;
use AppBundle\Validator\Constraints as AppAssert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PropinsiRepository")
 * @ORM\Table(name="propinsi", indexes={@ORM\Index(name="search_idx", columns={"code"})})
 *
 * @Serialize\ExclusionPolicy("all")
 **/
class Propinsi extends AbstractEntity
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
     * @ORM\Column(name="code", type="string", length=2, unique=true)
     *
     * @Serialize\Expose
     * @Assert\NotBlank
     *
     * @AppAssert\UniquePropinsiCode
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
     * @ORM\OneToMany(targetEntity="Kabupaten", mappedBy="propinsi")
     **/
    protected $kabupaten;

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
        $this->kabupaten = new ArrayCollection();
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
     * @return Propinsi
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
     * @return Propinsi
     */
    public function setName($name)
    {
        $this->name = strtoupper($name);

        return $this;
    }

    /**
     * Add kabupaten
     *
     * @param Kabupaten $kabupaten
     * @return Propinsi
     */
    public function addKabupaten(Kabupaten $kabupaten)
    {
        $this->kabupaten[] = $kabupaten;

        return $this;
    }

    /**
     * Remove kabupaten
     *
     * @param Kabupaten $kabupaten
     */
    public function removeKabupaten(Kabupaten $kabupaten)
    {
        $this->kabupaten->removeElement($kabupaten);
    }

    /**
     * Get kabupaten
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getKabupaten()
    {
        return $this->kabupaten;
    }
}
