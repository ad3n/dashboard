<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Chart\Kepesertaan\PertumbuhanPeserta;

use AppBundle\Chart\AbstractGrafik;
use AppBundle\Chart\DataCreator;
use Ihsan\MalesBundle\Serializer\Serializer;

class GrafikPertumbuhanPesertaPbi extends AbstractGrafik
{
    const CODE_INDIKATOR = 'PS01';
    const TITLE = 'GRAFIK PERTUMBUHAN PESERTA PBI';
    private $dataCreator;
    private $serializer;

    public function __construct(DataCreator $dataCreator, Serializer $serializer)
    {
        $this->dataCreator = $dataCreator;
        $this->serializer = $serializer;
    }

    public function createGrafikGlobal($format = 'json')
    {
        $data = array();

        for($i = self::TAHUN_INISIALISASI; $i <= date('Y'); $i++) {
            $data[$i] = $this->dataCreator->create(array(
                'indikator' => self::CODE_INDIKATOR,
                'tahun' => $i,
            ), 'global');
        }

        return $this->serializer->serialize($data, array(), $format);
    }

    public function createPropinsiPertahun($propinsi, $tahun, $format = 'json')
    {
        $data[$tahun] = $this->dataCreator->create(array(
            'indikator' => self::CODE_INDIKATOR,
            'propinsi' => $propinsi,
            'tahun' => $tahun,
        ), 'specific');

        return $this->serializer->serialize($data, array(), $format);
    }
}