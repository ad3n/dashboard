<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Security\Authentication;

use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Util\TokenGeneratorInterface;

class AuthenticationSuccessHandler extends DefaultAuthenticationSuccessHandler
{
    /**
     * @var \FOS\UserBundle\Model\UserManagerInterface
     **/
    protected $userManager;

    /**
     * @var \FOS\UserBundle\Util\TokenGeneratorInterface
     **/
    protected $tokenGenerator;

    public function __construct(UserManagerInterface $userManager, TokenGeneratorInterface $tokenGenerator, HttpUtils $httpUtils, array $options)
    {
        $this->userManager = $userManager;
        $this->tokenGenerator = $tokenGenerator;
        parent::__construct($httpUtils, $options);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if($request->isXmlHttpRequest()) {
            $user = $token->getUser();
            $user->setAuthenticationToken($this->tokenGenerator->generateToken());
            $this->userManager->updateUser($user);

            return new JsonResponse(array('success' => true, 'token' => $user->getAuthenticationToken()));
        }

        return parent::onAuthenticationSuccess($request, $token);
    }
}