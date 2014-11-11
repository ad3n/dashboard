<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Security\Logout;

use Symfony\Component\Security\Http\Logout\DefaultLogoutSuccessHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\HttpUtils;

class LogoutSuccessHandler extends DefaultLogoutSuccessHandler
{
    public function __construct(HttpUtils $httpUtils, $targetUrl = '/')
    {
        parent::__construct($httpUtils, $targetUrl);
    }

    public function onLogoutSuccess(Request $request)
    {
        if ($request->isXmlHttpRequest()) {

            return new JsonResponse(array('success' => true));
        }

        return parent::onLogoutSuccess($request);
    }
}