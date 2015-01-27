<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/chart/single")
 **/
class SingleChartApiController extends ApiController
{
    /**
     * @Route("/get/{indikator}/{scope}/{kode}/{tahun}/{bulan}", name="api_chart", defaults={"scope" = "nasional", "kode" = "0", "tahun" = "0", "bulan" = "0"})
     * @Method("GET")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     *
     * @param string $indikator
     * @param string $scope
     * @param string $kode
     * @param string $tahun
     * @param string $bulan
     * @return Response
     */
    public function getAction($indikator, $scope, $kode, $tahun, $bulan)
    {
        $indikator = strtoupper($indikator);
        $scope = strtolower($scope);
        $criteria = array('indikator' => $indikator);
        $output = array();

        if ('0' === $dari) {
            $date = new \DateTime();

            $criteria['dari']['tahun'] = $date->format('Y');
            $criteria['dari']['bulan'] = 1;
            $criteria['sampai']['tahun'] = $date->format('Y');
            $criteria['sampai']['bulan'] = 12;
        } else {
            $dari = explode('#', $dari);
            $sampai = explode('#', $sampai);

            $criteria['dari']['tahun'] = (int) $dari[0];
            $criteria['dari']['bulan'] = (int) $dari[1];
            $criteria['sampai']['tahun'] = (int) $sampai[0];
            $criteria['sampai']['bulan'] = (int) $sampai[1];
        }

        switch ($scope) {
            case 'nasional':

                $output = $this->createNasionalData($criteria);
                break;

            case 'propinsi':
                if ('' === $kode) {
                    throw new NotFoundHttpException('Data not found.');
                }
                $criteria['propinsi'] = $kode;

                $output = $this->createPropinsiData($criteria);
                break;

            case 'kabupaten':
                if ('' === $kode) {
                    throw new NotFoundHttpException('Data not found.');
                }
                $kode = explode('#', $kode);

                $criteria['propinsi'] = $kode[0];
                $criteria['kabupaten'] = $kode[1];

                $output = $this->createKabupatenData($criteria);
                break;

            case 'kecamatan':
                if ('' === $kode) {
                    throw new NotFoundHttpException('Data not found.');
                }
                $kode = explode('#', $kode);

                $criteria['propinsi'] = $kode[0];
                $criteria['kabupaten'] = $kode[1];
                $criteria['kecamatan'] = $kode[2];

                $output = $this->createKecamatanData($criteria);
                break;
        }

        return new Response($this->serialize($output, array()));
    }

    private function createNasionalData($criteria)
    {
        $output['scope'] = 'propinsi';
        $output['indikator'] = $this->getIndikatorByCode($criteria['indikator']);
        $output['data'] = $this->getData($criteria);

        return $output;
    }

    private function createPropinsiData($criteria)
    {
        $output['scope'] = 'kabupaten';
        $output['indikator'] = $this->getIndikatorByCode($criteria['indikator']);
        $output['data'] = $this->getData($criteria);

        return $output;
    }

    private function createKabupatenData($criteria)
    {
        $output['scope'] = 'kecamatan';
        $output['indikator'] = $this->getIndikatorByCode($criteria['indikator']);
        $output['data'] = $this->getData($criteria);

        return $output;
    }

    private function createKecamatanData($criteria)
    {
        $output['scope'] = 'kelurahan';
        $output['indikator'] = $this->getIndikatorByCode($criteria['indikator']);
        $output['data'] = $this->getData($criteria);

        return $output;
    }

    private function getIndikatorByCode($kodeIndikator)
    {
        $indikator = $this->getDoctrine()->getRepository('AppBundle:Indikator')->findOneBy(array('code' => $kodeIndikator));

        $output['code'] = $indikator->getCode();
        $output['name'] = $indikator->getName();
        $output['indikator_merah'] = $indikator->getIndikatorMerah();
        $output['indikator_kuning'] = $indikator->getIndikatorKuning();
        $output['indikator_hijau'] = $indikator->getIndikatorHijau();

        return $output;
    }

    private function getData($criteria)
    {
        $output = array();
        $dariTahun = $criteria['dari']['tahun'];
        $dariBulan = $criteria['dari']['bulan'];
        $sampaiTahun = $criteria['sampai']['tahun'];
        $sampaiBulan = $criteria['sampai']['bulan'];

        unset($criteria['dari'], $criteria['sampai']);

        for ($i = $dariTahun; $i <= $sampaiTahun; $i++) {
            for ($j = $dariBulan; $j <= $sampaiBulan; $j++) {
                $criteria['tahun'] = $i;
                $criteria['bulan'] = $j;
                $data = $this->getDoctrine()->getRepository('AppBundle:Data')->findBy($criteria);

                foreach ($data as $key => $result) {
                    $output[$result->getTahun()][$result->getBulan()]['nominator'] = $result->getNominator();
                    $output[$result->getTahun()][$result->getBulan()]['denominator'] = $result->getDeNominator();
                    $output[$result->getTahun()][$result->getBulan()]['value'] = $result->getValue();
                }
            }
        }

        return $output;
    }
}