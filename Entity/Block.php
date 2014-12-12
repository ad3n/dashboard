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
use AppBundle\Entity\User;

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
     * @ORM\ManyToOne(targetEntity="Chart", inversedBy="block")
     * @ORM\JoinColumn(name="chart_id", referencedColumnName="id")
     *
     * @Serialize\Expose
     **/
    protected $chart;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="block")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @Serialize\Expose
     **/
    protected $user;

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
     * Set chart
     *
     * @param Chart $chart
     * @return Block
     */
    public function setChart(Chart $chart = null)
    {
        $this->chart = $chart;

        return $this;
    }

    /**
     * Get chart
     *
     * @return Chart
     */
    public function getChart()
    {
        return $this->chart;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return Block
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
