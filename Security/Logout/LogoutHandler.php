<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Security\Logout;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Model\UserManagerInterface;

class LogoutHandler implements LogoutHandlerInterface
{
    /**
     * @var \FOS\UserBundle\Model\UserManagerInterface
     **/
    protected $userManager;

    public function __construct(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    public function logout(Request $request, Response $response, TokenInterface $token)
    {
        if ($request->isXmlHttpRequest()) {
            $user = $token->getUser();
            $user->setAuthenticationToken(null);

            $this->userManager->updateUser($user);
        }
    }
}
