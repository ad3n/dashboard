<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Controller;

use AppBundle\Chart\Kepesertaan\PertumbuhanPeserta\GrafikPertumbuhanPesertaPbi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DemoController extends Controller
{
    /**
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     **/
    public function dashboardAction()
    {
        return $this->render('AppBundle:Demo:main.html.twig');
    }

    /**
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     **/
    public function indikatorAction()
    {
        return $this->render('AppBundle:Demo:indikator.html.twig', array('type' => 'submit', 'propinsi' => $this->getPropinsi()));
    }

    /**
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     **/
    public function queryAction()
    {
        return $this->render('AppBundle:Demo:indikator.html.twig', array('type' => 'query', 'propinsi' => $this->getPropinsi()));
    }

    /**
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