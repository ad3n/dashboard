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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serialize;
use Ihsan\MalesBundle\Entity\AbstractEntity;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\IndikatorRepository")
 * @ORM\Table(name="indikator")
 *
 * @Serialize\ExclusionPolicy("all")
 **/
class Indikator extends AbstractEntity
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
     * @ORM\OneToMany(targetEntity="Indikator", mappedBy="parent")
     **/
    protected $child;

    /**
     * @ORM\ManyToOne(targetEntity="Indikator", inversedBy="child")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     *
     * @Serialize\Expose
     **/
    protected $parent;

    /**
     * @ORM\Column(name="code", type="string", length=4)
     *
     * @Serialize\Expose
     * @Assert\NotBlank
     * @Assert\Length(min="2", minMessage="form.error.min", max="4", maxMessage="form.error.max")
     **/
    protected $code;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Serialize\Expose
     * @Assert\NotBlank
     * @Assert\Length(min="3", minMessage="form.error.min", max="255", maxMessage="form.error.max")
     **/
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Block", mappedBy="indikator")
     **/
    protected $block;

    public function __construct()
    {
        $this->child = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @Serialize\VirtualProperty
     * @Serialize\SerializedName("type")
     * @Serialize\Groups({"tree"})
     *
     * @return string
     **/
    public function getType()
    {
        if ($this->parent) {
            return 'dir';
        }

        return 'file';
    }

    /**
     * @Serialize\VirtualProperty
     * @Serialize\SerializedName("file")
     * @Serialize\Groups({"tree"})
     *
     * @return string
     **/
    public function getNode()
    {
        return $this->name;
    }

    /**
     * @Serialize\VirtualProperty
     * @Serialize\SerializedName("ext")
     * @Serialize\Groups({"tree"})
     *
     * @return string
     **/
    public function getExt()
    {
        if (! empty($this->child)) {
            return 'ext_folder';
        }

        return 'ext_md';
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setName($name)
    {
        $this->name = strtoupper($name);

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function addChild(Indikator $child)
    {
        $this->child[] = $child;
        $child->setParent($this);

        return $this;
    }

    public function getChild()
    {
        return $this->child;
    }

    public function setParent(Indikator $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @Serialize\VirtualProperty
     * @Serialize\SerializedName("dir")
     * @Serialize\Groups({"tree"})
     *
     * @return string
     **/
    public function getParent()
    {
        return $this->parent;
    }

    public function removeChild(Indikator $child)
    {
        $this->child->removeElement($child);
    }

    /**
     * Add block
     *
     * @param Block $block
     * @return Indikator
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
}
