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
    public function findByIndikator($indikator)
    {
        return $this->findBy(array('indikator' => $indikator));
    }

    public function findByBulan($bulan, $tahun)
    {
        return $this->findBy(array('bulan' => $bulan, 'tahun' => $tahun));
    }

    public function findByTahun($tahun)
    {
        return $this->findBy(array('tahun' => $tahun));
    }

    public function findByKelurahan($kelurahan)
    {
        return $this->findBy(array('kelurahan' => $kelurahan));
    }

    public function findByKecamatan($kecamatan)
    {
        return $this->findBy(array('kecamatan' => $kecamatan));
    }

    public function findByKabupaten($kabupaten)
    {
        return $this->findBy(array('kabupaten' => $kabupaten));
    }

    public function findByPropinsi($propinsi)
    {
        return $this->findBy(array('propinsi' => $propinsi));
    }

    public function findByIndikatorBulan($indikator, $bulan, $tahun)
    {
        return $this->findBy(array('indikator' => $indikator, 'bulan' => $bulan, 'tahun' => $tahun));
    }

    public function findByIndikatorTahun($indikator, $tahun)
    {
        return $this->findBy(array('indikator' => $indikator, 'tahun' => $tahun));
    }

    public function findByIndikatorKelurahan($indikator, $kelurahan)
    {
        return $this->findBy(array('indikator' => $indikator, 'kelurahan' => $kelurahan));
    }

    public function findByIndikatorKecamatan($indikator, $kecamatan)
    {
        return $this->findBy(array('indikator' => $indikator, 'kecamatan' => $kecamatan));
    }

    public function findByIndikatorKebupaten($indikator, $kabupaten)
    {
        return $this->findBy(array('indikator' => $indikator, 'kabupaten' => $kabupaten));
    }

    public function findByIndikatorPropinsi($indikator, $propinsi)
    {
        return $this->findBy(array('indikator' => $indikator, 'propinsi' => $propinsi));
    }

    public function findByBulanKelurahan($bulan, $tahun, $kelurahan)
    {
        return $this->findBy(array('bulan' => $bulan, 'tahun' => $tahun, 'kelurahan' => $kelurahan));
    }

    public function findByBulanKecamatan($bulan, $tahun, $kecamatan)
    {
        return $this->findBy(array('bulan' => $bulan, 'tahun' => $tahun, 'kecamatan' => $kecamatan));
    }

    public function findByBulanKabupaten($bulan, $tahun, $kabupaten)
    {
        return $this->findBy(array('bulan' => $bulan, 'tahun' => $tahun, 'kabupaten' => $kabupaten));
    }

    public function findByBulanPropinsi($bulan, $tahun, $propinsi)
    {
        return $this->findBy(array('bulan' => $bulan, 'tahun' => $tahun, 'propinsi' => $propinsi));
    }

    public function findByTahunKelurahan($tahun, $kelurahan)
    {
        return $this->findBy(array('tahun' => $tahun, 'kelurahan' => $kelurahan));
    }

    public function findByTahunKecamatan($tahun, $kecamatan)
    {
        return $this->findBy(array('tahun' => $tahun, 'kecamatan' => $kecamatan));
    }

    public function findByTahunKabupaten($tahun, $kabupaten)
    {
        return $this->findBy(array('tahun' => $tahun, 'kabupaten' => $kabupaten));
    }

    public function findByTahunPropinsi($tahun, $propinsi)
    {
        return $this->findBy(array('tahun' => $tahun, 'propinsi' => $propinsi));
    }
}
