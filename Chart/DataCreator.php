<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Chart;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityNotFoundException;

class DataCreator
{
    private $objectManager;

    public function __construct(ObjectManager $manager)
    {
        $this->objectManager = $manager;
    }

    /**
     * @param string $kodeIndikator
     * @param string $propinsi
     * @param string $kabupaten
     * @param string $kecamatan
     * @param string $kelurahan
     * @param string $bulan
     * @param string $tahun
     * @throws EntityNotFoundException
     */
    private function createSpecificData($kodeIndikator, $propinsi, $kabupaten = null, $kecamatan = null, $kelurahan = null, $tahun = null, $bulan = null)
    {
        $indikator = $this->objectManager->getRepository('AppBundle:Indikator')->findOneBy(array('code' => $kodeIndikator));
        $repository = $this->objectManager->getRepository('AppBundle:Data');

        if (! $indikator) {
            throw new EntityNotFoundException(sprintf('indikator dengan kode %s tidak ditemukan', $kodeIndikator));
        }

        if (null === $tahun) {
           $tahun = date('Y');
        }

        if (! $kabupaten) {
            if (! $bulan) {
                return $repository->findByIndikatorPropinsiTahun($kodeIndikator, $propinsi, (int) $tahun);
            } else {
                return $repository->findByIndikatorPropinsiBulan($kodeIndikator, $propinsi, (int) $tahun, (int) $bulan);
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

    private function createGlobalData($dariTahun, $sampaiTahun, $kodeIndikator, $propinsi, $kabupaten = null, $kecamatan = null, $kelurahan = null)
    {

    }
}