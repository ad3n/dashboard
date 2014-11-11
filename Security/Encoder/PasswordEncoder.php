<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Security\Encoder;

class PasswordEncoder implements PasswordEncoderInterface
{
    /**
     * @var GeneratorInterface
     **/
    protected $generator;

    public function __construct(GeneratorInterface $generator)
    {
        $this->generator = $generator;
    }

    /**
     * Encodes the raw password.
     *
     * @param string $raw The password to encode
     * @param string $salt The salt
     *
     * @return string The encoded password
     */
    public function encodePassword($raw, $salt)
    {
        return $this->generator->generate(sprintf('%s%s', $this->generator->generate($raw), $salt));
    }

    /**
     * Checks a raw password against an encoded password.
     *
     * @param string $encoded An encoded password
     * @param string $raw A raw password
     * @param string $salt The salt
     *
     * @return bool    true if the password is valid, false otherwise
     */
    public function isPasswordValid($encoded, $raw, $salt)
    {
        return $encoded === $this->encodePassword($raw, $salt);
    }

    /**
     * Generate salt from raw password
     *
     * @param string $raw
     * @return string
     **/
    public function generateSalt($raw)
    {
        return $this->generator->generate(sprintf('%s%s', $raw, $this->generator->generate(uniqid('', true))));
    }
}