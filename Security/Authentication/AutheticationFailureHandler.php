<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Security\Authentication;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;

class AutheticationFailureHandler extends DefaultAuthenticationFailureHandler
{
    /**
     * @var Symfony\Component\Translation\TranslatorInterface
     **/
    protected $translator;

    public function __construct(TranslatorInterface $translator, HttpKernelInterface $httpKernel, HttpUtils $httpUtils, array $options, LoggerInterface $logger = null)
    {
        $this->translator = $translator;
        parent::__construct($httpKernel, $httpUtils, $options, $logger);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        if($request->isXmlHttpRequest()) {

            return new JsonResponse(array('success' => false, 'message' => $this->translator->trans($exception->getMessage())));
        }

        return parent::onAuthenticationFailure($request, $exception);
    }
}