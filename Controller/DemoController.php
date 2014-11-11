<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/demo")
 *
 * Class DemoController
 * @package AppBundle\Controller
 **/
class DemoController extends Controller
{
    /**
     * @Route("/dashboard", name="home_dashboard")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     **/
    public function dashboardAction()
    {
        return $this->render('AppBundle:Demo:main.html.twig');
    }

    /**
     * @Route("/indikator", name="indikator_dashboard")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     **/
    public function indikatorAction()
    {
        return $this->render('AppBundle:Demo:indikator.html.twig', array('type' => 'submit', 'propinsi' => $this->getPropinsi()));
    }

    /**
     * @Route("/query", name="query_dashboard")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     **/
    public function queryAction()
    {
        return $this->render('AppBundle:Demo:indikator.html.twig', array('type' => 'query', 'propinsi' => $this->getPropinsi()));
    }

    /**
     * @Route("/report", name="report_dashboard")
     * @Method("POST")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     **/
    public function reportAction()
    {
        return $this->render('AppBundle:Demo:report.html.twig');
    }

    protected function getPropinsi()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Wilayah')->findAllPropinsi();
    }
}