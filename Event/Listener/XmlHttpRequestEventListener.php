<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Event\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Ihsan\MalesBundle\Serializer\Serializer;

class XmlHttpRequestEventListener
{
    protected $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $request = $event->getRequest();

        if ($request->isXmlHttpRequest()) {
            $event->setResponse(new Response($this->serializer->serialize($event->getException()->getMessage(), array(), 'json')));
        }
    }
}