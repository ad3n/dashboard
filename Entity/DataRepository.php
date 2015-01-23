<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class DataRepository extends EntityRepository
{
    public function findByIndikatorKelurahanTahun($indikator, $propinsi, $kabupaten, $kecamatan, $kelurahan, $tahun)
    {
        return $this->findBy(array(
            'indikator' => $indikator,
            'propinsi' => $propinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'tahun' => $tahun,
        ));
    }

    public function findByIndikatorKelurahanBulan($indikator, $propinsi, $kabupaten, $kecamatan, $kelurahan, $tahun, $bulan)
    {
        return $this->findBy(array(
            'indikator' => $indikator,
            'propinsi' => $propinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'tahun' => $tahun,
            'bulan' => $bulan,
        ));
    }

    public function findByIndikatorKecamatanTahun($indikator, $propinsi, $kabupaten, $kecamatan, $tahun)
    {
        return $this->findBy(array(
            'indikator' => $indikator,
            'propinsi' => $propinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'tahun' => $tahun,
        ));
    }

    public function findByIndikatorKecamatanBulan($indikator, $propinsi, $kabupaten, $kecamatan, $tahun, $bulan)
    {
        return $this->findBy(array(
            'indikator' => $indikator,
            'propinsi' => $propinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'tahun' => $tahun,
            'bulan' => $bulan,
        ));
    }

    public function findByIndikatorKabupatenTahun($indikator, $propinsi, $kabupaten, $tahun)
    {
        return $this->findBy(array(
            'indikator' => $indikator,
            'propinsi' => $propinsi,
            'kabupaten' => $kabupaten,
            'tahun' => $tahun,
        ));
    }

    public function findByIndikatorKabupatenBulan($indikator, $propinsi, $kabupaten, $tahun, $bulan)
    {
        return $this->findBy(array(
            'indikator' => $indikator,
            'propinsi' => $propinsi,
            'kabupaten' => $kabupaten,
            'tahun' => $tahun,
            'bulan' => $bulan,
        ));
    }

    public function findByIndikatorPropinsiTahun($indikator, $propinsi, $tahun)
    {
        return $this->findBy(array(
            'indikator' => $indikator,
            'propinsi' => $propinsi,
            'tahun' => $tahun,
        ));
    }

    public function findByIndikatorPropinsiBulan($indikator, $propinsi, $tahun, $bulan)
    {
        return $this->findBy(array(
            'indikator' => $indikator,
            'propinsi' => $propinsi,
            'tahun' => $tahun,
            'bulan' => $bulan,
        ));
    }
}
