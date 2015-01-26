<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Chart;

use AppBundle\Util\BulanIndonesia;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\Validator\Exception\OutOfBoundsException;

class DataCreator
{
    private $objectManager;

    public function __construct(ObjectManager $manager)
    {
        $this->objectManager = $manager;
    }

    public function create(array $parameters, $type = 'specific')
    {
        if (! array_key_exists('tahun', $parameters)) {
            $parameters['tahun'] = date('Y');
        }

        switch ($type) {
            case 'specific':
                if (! array_key_exists('indikator', $parameters) || ! array_key_exists('propinsi', $parameters)) {
                    throw new OutOfBoundsException(sprintf('indikator dan propinsi diperlukan.'));
                }

                return $this->createSpecificData(
                    $parameters['indikator'],
                    $parameters['propinsi'],
                    array_key_exists('kabupaten', $parameters) ? $parameters['kabupaten'] : null,
                    array_key_exists('kecamatan', $parameters) ? $parameters['kecamatan'] : null,
                    array_key_exists('kelurahan', $parameters) ? $parameters['kelurahan'] : null,
                    $parameters['tahun'],
                    array_key_exists('bulan', $parameters) ? $parameters['bulan'] : null
                );
                break;
            case 'global':
                return $this->createGlobalData(
                    $parameters['indikator'],
                    $parameters['tahun'],
                    array_key_exists('bulan', $parameters) ? $parameters['bulan'] : null
                );
                break;
        }
    }

    private function createSpecificData($kodeIndikator, $propinsi, $kabupaten = null, $kecamatan = null, $kelurahan = null, $tahun = null, $bulan = null)
    {
        $this->isExistOrExceptionIndikator($kodeIndikator);
        $repository = $this->objectManager->getRepository('AppBundle:Data');

        if (null === $tahun) {
           $tahun = date('Y');
        }

        if (! $kabupaten) {
            if (! $bulan) {
                $results = $repository->findByIndikatorPropinsiTahun($kodeIndikator, $propinsi, (int) $tahun);
                $data = array();

                foreach ($results as $key => $result) {
                    $data[BulanIndonesia::convertToText($result->getBulan())] = $result->getValue();
                }

                return $data;
            } else {
                $data[BulanIndonesia::convertToText((int) $bulan)] = $repository->findByIndikatorPropinsiBulan($kodeIndikator, $propinsi, (int) $tahun, (int) $bulan);

                return $data;
            }
        }

        if (! $kecamatan) {
            if (! $kabupaten) {
                throw new \BadMethodCallException('kode kabupaten diperlukan.');
            }

            if (! $bulan) {
                return $repository->findByIndikatorKabupatenTahun($kodeIndikator, $propinsi, $kabupaten, (int) $tahun);
            } else {
                return $repository->findByIndikatorKabupatenBulan($kodeIndikator, $propinsi, $kabupaten, (int) $tahun, (int) $bulan);
            }
        }

        if (! $kelurahan) {
            if (! $kabupaten || ! $kecamatan) {
                throw new \BadMethodCallException('kode kabupaten dan kode kecamatan diperlukan.');
            }

            if (! $bulan) {
                return $repository->findByIndikatorKecamatanTahun($kodeIndikator, $propinsi, $kabupaten, $kecamatan, (int) $tahun);
            } else {
                return $repository->findByIndikatorKecamatanBulan($kodeIndikator, $propinsi, $kabupaten, $kecamatan, (int) $tahun, (int) $bulan);
            }
        }

        if (! $bulan) {
            return $repository->findByIndikatorKelurahanTahun($kodeIndikator, $propinsi, $kabupaten, $kecamatan, $kelurahan, (int) $tahun);
        } else {
            return $repository->findByIndikatorKelurahanBulan($kodeIndikator, $propinsi, $kabupaten, $kecamatan, $kelurahan, (int) $tahun, (int) $bulan);
        }
    }

    private function createGlobalData($kodeIndikator, $tahun, $bulan = null)
    {
        $this->isExistOrExceptionIndikator($kodeIndikator);

        $repository = $this->objectManager->getRepository('AppBundle:Data');

        if (! $bulan) {
            $results = $repository->findByIndikatorTahun($kodeIndikator, (int) $tahun);
            $data = array();

            foreach ($results as $key => $result) {
                $data[BulanIndonesia::convertToText($result->getBulan())] = $result->getValue();
            }

            return $data;

        } else {
            $data[BulanIndonesia::convertToText((int) $bulan)] = $repository->findByIndikatorBulan($kodeIndikator, (int) $tahun, (int) $bulan);

            return $data;
        }
    }

    private function isExistOrExceptionIndikator($kodeIndikator)
    {
        $indikator = $this->objectManager->getRepository('AppBundle:Indikator')->findOneBy(array('code' => $kodeIndikator));

        if (! $indikator) {
            throw new EntityNotFoundException(sprintf('indikator dengan kode %s tidak ditemukan', $kodeIndikator));
        }

        return true;
    }
}