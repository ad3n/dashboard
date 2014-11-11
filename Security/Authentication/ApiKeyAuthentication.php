<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Security\Authentication;

use Symfony\Component\Security\Core\Authentication\SimplePreAuthenticatorInterface;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Security\UserProvider;
use FOS\UserBundle\Doctrine\UserManager;

class ApiKeyAuthentication implements SimplePreAuthenticatorInterface
{
    /**
     * @var UserManager
     **/
    protected $userManager;

    /**
     * @var UserProvider
     **/
    protected $userProvider;

    public function __construct(UserManager $userManager, UserProvider $userProvider)
    {
        $this->userManager = $userManager;
        $this->userProvider = $userProvider;
    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        $apiKey = $token->getCredentials();
        $username = $this->userManager->findUserBy(array('authenticationToken' => $apiKey));

        if (! $username) {
            throw new AuthenticationException(
                sprintf('API Key "%s" does not exist.', $apiKey)
            );
        }

        $user = $this->userProvider->loadUserByUsername($username);

        return new PreAuthenticatedToken(
            $user,
            $apiKey,
            $providerKey,
            $user->getRoles()
        );
    }

    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
    }

    public function createToken(Request $request, $providerKey)
    {
        $apiKey = $request->query->get('api');

        if (!$apiKey) {
            throw new BadCredentialsException('No API Key found.');
        }

        return new PreAuthenticatedToken(
            'anon.',
            $apiKey,
            $providerKey
        );
    }
}