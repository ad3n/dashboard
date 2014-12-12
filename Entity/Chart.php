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
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ChartRepository")
 * @ORM\Table(name="chart")
 *
 * @Serialize\ExclusionPolicy("all")
 **/
class Chart extends AbstractEntity
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
     * @ORM\Column(name="name", type="string", length=27)
     *
     * @Serialize\Expose
     * @Assert\NotBlank
     * @Assert\Length(min="2", minMessage="form.error.min", max="27", maxMessage="form.error.max")
     **/
    protected $name;

    /**
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     *
     * @Serialize\Expose
     * @Assert\NotBlank
     * @Assert\Length(min="2", minMessage="form.error.min", max="255", maxMessage="form.error.max")
     **/
    protected $description;

    /**
     * @ORM\Column(name="chart_type", type="string", length=17)
     *
     * @Serialize\Expose
     * @Assert\NotBlank
     * @Assert\Length(min="2", minMessage="form.error.min", max="17", maxMessage="form.error.max")
     **/
    protected $chartType;

    /**
     * @ORM\Column(name="query", type="string", length=255)
     *
     * @Serialize\Expose
     * @Assert\NotBlank
     * @Assert\Length(min="2", minMessage="form.error.min", max="255", maxMessage="form.error.max")
     **/
    protected $query;

    /**
     * @ORM\OneToMany(targetEntity="Block", mappedBy="chart")
     **/
    protected $block;

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
        $this->block = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Chart
     */
    public function setName($name)
    {
        $this->name = strtoupper($name);

        return $this;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Chart
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set query
     *
     * @param string $query
     * @return Chart
     */
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get query
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Set chartType
     *
     * @param string $chartType
     * @return Chart
     */
    public function setType($chartType)
    {
        $this->chartType = $chartType;

        return $this;
    }

    /**
     * Get chartType
     *
     * @return string 
     */
    public function getType()
    {
        return $this->chartType;
    }

    /**
     * Add block
     *
     * @param Block $block
     * @return Chart
     */
    public function addBlock(Block $block)
    {
        $this->block[] = $block;

        return $this;
    }

    /**
     * Remove block
     *
     * @param Block $block
     */
    public function removeBlock(Block $block)
    {
        $this->block->removeElement($block);
    }

    /**
     * Get block
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * Set chartType
     *
     * @param string $chartType
     * @return Chart
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
}
