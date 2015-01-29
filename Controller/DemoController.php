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
        return $this->render('AppBundle:Demo:main.html.twig', $this->createIndikatorMenu());
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

    private function getPropinsi()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Wilayah')->findAllPropinsi();
    }

    private function createIndikatorMenu()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Indikator');
        $kepesertaan = $repository->getChildIndikatorByParentCode('PS00');
        $pelayanan = $repository->getChildIndikatorByParentCode('PL00');
        $iuran = $repository->getChildIndikatorByParentCode('IU00');
        $pembayaran = $repository->getChildIndikatorByParentCode('PP00');
        $keuangan = $repository->getChildIndikatorByParentCode('KN00');
        $kelembagaan = $repository->getChildIndikatorByParentCode('OK00');
        $output = array();

        $output['kepesertaan'] = '';
        foreach ($kepesertaan as $key => $value) {
            $output['kepesertaan'] .= sprintf('<li><a href="%s">%s</a></li>', '#', $value->getName());
        }

        $output['pelayanan'] = '';
        foreach ($pelayanan as $key => $value) {
            $output['pelayanan'] .= sprintf('<li><a href="%s">%s</a></li>', '#', $value->getName());
        }

        $output['iuran'] = '';
        foreach ($iuran as $key => $value) {
            $output['iuran'] .= sprintf('<li><a href="%s">%s</a></li>', '#', $value->getName());
        }

        $output['pembayaran'] = '';
        foreach ($pembayaran as $key => $value) {
            $output['pembayaran'] .= sprintf('<li><a href="%s">%s</a></li>', '#', $value->getName());
        }

        $output['keuangan'] = '';
        foreach ($keuangan as $key => $value) {
            $output['keuangan'] .= sprintf('<li><a href="%s">%s</a></li>', '#', $value->getName());
        }

        $output['kelembagaan'] = '';
        foreach ($kelembagaan as $key => $value) {
            $output['kelembagaan'] .= sprintf('<li><a href="%s">%s</a></li>', '#', $value->getName());
        }

        return $output;
    }
}