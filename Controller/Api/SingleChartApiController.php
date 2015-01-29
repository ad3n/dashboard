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
     * @Route("/get/{indikator}/{scope}/{kode}/{dari}/{sampai}", name="api_chart", defaults={"scope" = "nasional", "kode" = "0", "dari" = "0", "sampai" = "0"})
     * @Method("GET")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     *
     * @param string $indikator
     * @param string $scope
     * @param string $kode
     * @param string $dari
     * @param string $sampai
     * @return Response
     */
    public function getAction($indikator, $scope, $kode, $dari, $sampai)
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
            $dari = explode('_', $dari);
            $sampai = explode('_', $sampai);

            $criteria['dari']['tahun'] = (int) $dari[1];
            $criteria['dari']['bulan'] = (int) $dari[0];
            $criteria['sampai']['tahun'] = (int) $sampai[1];
            $criteria['sampai']['bulan'] = (int) $sampai[0];
        }

        $output['indikator'] = $this->getIndikatorByCode($criteria['indikator']);

        switch ($scope) {
            case 'nasional':

                $output = array_merge($output, $this->createNasionalData($criteria));
                break;

            case 'propinsi':
                if ('' === $kode) {
                    throw new NotFoundHttpException('Data not found.');
                }
                $criteria['propinsi'] = $kode;

                $output = array_merge($output, $this->createPropinsiData($criteria));
                break;

            case 'kabupaten':
                if ('' === $kode) {
                    throw new NotFoundHttpException('Data not found.');
                }
                $kode = explode('_', $kode);

                $criteria['propinsi'] = $kode[0];
                $criteria['kabupaten'] = $kode[1];

                $output = array_merge($output, $this->createKabupatenData($criteria));
                break;

            case 'kecamatan':
                if ('' === $kode) {
                    throw new NotFoundHttpException('Data not found.');
                }
                $kode = explode('_', $kode);

                $criteria['propinsi'] = $kode[0];
                $criteria['kabupaten'] = $kode[1];
                $criteria['kecamatan'] = $kode[2];

                $output = array_merge($output, $this->createKecamatanData($criteria));
                break;
        }

        return new Response($this->serialize($output, array()));
    }

    private function createNasionalData($criteria)
    {
        $output['scope'] = 'propinsi';
        $output['data'] = $this->getData($criteria);

        return $output;
    }

    private function createPropinsiData($criteria)
    {
        $output['scope'] = 'kabupaten';
        $output['data'] = $this->getData($criteria);

        return $output;
    }

    private function createKabupatenData($criteria)
    {
        $output['scope'] = 'kecamatan';
        $output['data'] = $this->getData($criteria);

        return $output;
    }

    private function createKecamatanData($criteria)
    {
        $output['scope'] = 'kelurahan';
        $output['data'] = $this->getData($criteria);

        return $output;
    }

    private function getIndikatorByCode($kodeIndikator)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Indikator');
        $indikator = $repository->findOneBy(array('code' => $kodeIndikator));

        $output['code'] = $indikator->getCode();
        $output['name'] = $indikator->getName();
        $output['indikator_merah'] = $indikator->getIndikatorMerah();
        $output['indikator_kuning'] = $indikator->getIndikatorKuning();
        $output['indikator_hijau'] = $indikator->getIndikatorHijau();

        $childs = $repository->getChildIndikatorByParentCode($output['code']);

        foreach ($childs as $key => $child) {
            $output['child'][] = array(
                'code' => $child->getCode(),
                'name' => $child->getName(),
            );
        }

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
                $data = $this->getDoctrine()->getRepository('AppBundle:Data')->findBy($criteria, array('indikator' => 'ASC'));

                if (! array_key_exists($criteria['tahun'], $output)) {
                    $output[$criteria['tahun']] = array();
                }

                if (! array_key_exists($criteria['bulan'], $output[$criteria['tahun']])) {
                    $output[$criteria['tahun']][$criteria['bulan']] = array();
                }

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