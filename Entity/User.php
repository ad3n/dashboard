<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 **/
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    protected $id;

    /**
     * @ORM\Column(name="full_name", type="string", length=77, nullable=true)
     **/
    protected $fullName;

    /**
     * @ORM\Column(name="authentication_token", type="string", length=40, nullable=true)
     **/
    protected $authenticationToken;

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
        $this->fullName = $fullName;

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
}
