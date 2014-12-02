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
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BlockRepository")
 * @ORM\Table(name="block")
 *
 * @Serialize\ExclusionPolicy("all")
 **/
class Block extends AbstractEntity
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
     * @ORM\Column(name="block_id", type="string", length=9)
     *
     * @Serialize\Expose
     * @Assert\NotBlank
     * @Assert\Length(min="2", minMessage="form.error.min", max="9", maxMessage="form.error.max")
     **/
    protected $blockId;

    /**
     * @ORM\Column(name="chart_type", type="string", length=17)
     *
     * @Serialize\Expose
     * @Assert\NotBlank
     * @Assert\Length(min="2", minMessage="form.error.min", max="17", maxMessage="form.error.max")
     **/
    protected $chartType;

    /**
     * @ORM\ManyToOne(targetEntity="Indikator", inversedBy="block")
     * @ORM\JoinColumn(name="indikator_id", referencedColumnName="id")
     *
     * @Serialize\Expose
     **/
    protected $indikator;

    /**
     * @ORM\Column(name="status", type="boolean")
     *
     * @Serialize\Expose
     * @Assert\NotBlank
     **/
    protected $status;

    public function __construct()
    {
        $this->status = true;
    }

    /**
     * @return string
     **/
    public function getName()
    {
        return $this->blockId;
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
     * Set blockId
     *
     * @param string $blockId
     * @return Block
     */
    public function setBlockId($blockId)
    {
        $this->blockId = $blockId;

        return $this;
    }

    /**
     * Get blockId
     *
     * @return string 
     */
    public function getBlockId()
    {
        return $this->blockId;
    }

    /**
     * Set chartType
     *
     * @param string $chartType
     * @return Block
     */
    public function setChartType($chartType)
    {
        $this->chartType = $chartType;

        return $this;
    }

    /**
     * Get chartType
     *
     * @return string 
     */
    public function getChartType()
    {
        return $this->chartType;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Block
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set indikator
     *
     * @param Indikator $indikator
     * @return Block
     */
    public function setIndikator(Indikator $indikator = null)
    {
        $this->indikator = $indikator;

        return $this;
    }

    /**
     * Get indikator
     *
     * @return Indikator
     */
    public function getIndikator()
    {
        return $this->indikator;
    }
}
