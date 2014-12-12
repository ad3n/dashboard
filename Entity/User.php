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
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Ihsan\MalesBundle\Entity\EntityInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 **/
class User extends BaseUser implements EntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    protected $id;

    /**
     * @ORM\Column(name="full_name", type="string", length=77, nullable=true)
     *
     * @Assert\NotBlank
     * @Assert\Length(min="3", minMessage="form.error.min", max="77", maxMessage="form.error.max")
     **/
    protected $fullName;

    /**
     * @ORM\Column(name="authentication_token", type="string", length=40, nullable=true)
     **/
    protected $authenticationToken;

    /**
     * @ORM\OneToMany(targetEntity="Block", mappedBy="user")
     **/
    protected $block;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setFullName($fullName)
    {
        $this->fullName = strtoupper($fullName);

        return $this;
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function setAuthenticationToken($authenticationToken)
    {
        $this->authenticationToken = $authenticationToken;

        return $this;
    }

    public function getAuthenticationToken()
    {
        return $this->authenticationToken;
    }

    public function getName()
    {
        return $this->fullName;
    }

    public function getFilter()
    {
        return 'username';
    }

    public function getProperties()
    {
        return get_object_vars($this);
    }

    public function __toString()
    {
        return $this->fullName;
    }

    public function addBlock(\AppBundle\Entity\Block $block)
    {
        $this->block[] = $block;

        return $this;
    }

    public function removeBlock(\AppBundle\Entity\Block $block)
    {
        $this->block->removeElement($block);
    }

    public function getBlock()
    {
        return $this->block;
    }
}
