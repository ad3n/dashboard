<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="")
     **/
    public function indexAction()
    {
        $accessToken = $this->container->get('security.context')->getToken()->getAccessToken();

        var_dump($accessToken);

        return $this->render('AppBundle:Home:index.html.twig');
    }
}