<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Security\Encoder;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface as BaseEncoder;

interface PasswordEncoderInterface extends BaseEncoder
{
    /**
     * Generate salt from plain password
     *
     * @param string $plainPassword
     * @return string
     **/
    public function generateSalt($plainPassword);
}