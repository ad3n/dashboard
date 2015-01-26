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

    public function findByIndikatorTahun($indikator, $tahun)
    {
        return $this->findBy(array(
            'indikator' => $indikator,
            'tahun' => $tahun,
        ));
    }

    public function findByIndikatorBulan($indikator, $tahun, $bulan)
    {
        return $this->findBy(array(
            'indikator' => $indikator,
            'tahun' => $tahun,
            'bulan' => $bulan,
        ));
    }

    public function findByIndikatorKelurahanSummary($dariTahun, $sampaiTahun, $indikator, $propinsi, $kabupaten, $kecamatan, $kelurahan)
    {
        $queryBuilder = $this->createQueryBuilder('d');
        $queryBuilder->andWhere('d.indikator = :indikator');
        $queryBuilder->andWhere('d.propinsi = :propinsi');
        $queryBuilder->andWhere('d.kabupaten = :kabupaten');
        $queryBuilder->andWhere('d.kecamatan = :kecamatan');
        $queryBuilder->andWhere('d.kelurahan = :kelurahan');
        $queryBuilder->andWhere('d.tahun BETWEEN :from AND :to');
        $queryBuilder->setParameters(array(
            'indikator' => $indikator,
            'propinsi' => $propinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'from' => $dariTahun,
            'to' => $sampaiTahun,
        ));

        return $queryBuilder->getQuery()->getResult();
    }

    public function findByIndikatorKecamatanSummary($dariTahun, $sampaiTahun, $indikator, $propinsi, $kabupaten, $kecamatan)
    {
        $queryBuilder = $this->createQueryBuilder('d');
        $queryBuilder->andWhere('d.indikator = :indikator');
        $queryBuilder->andWhere('d.propinsi = :propinsi');
        $queryBuilder->andWhere('d.kabupaten = :kabupaten');
        $queryBuilder->andWhere('d.kecamatan = :kecamatan');
        $queryBuilder->andWhere('d.tahun BETWEEN :from AND :to');
        $queryBuilder->setParameters(array(
            'indikator' => $indikator,
            'propinsi' => $propinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'from' => $dariTahun,
            'to' => $sampaiTahun,
        ));

        return $queryBuilder->getQuery()->getResult();
    }

    public function findByIndikatorKabupatenSummary($dariTahun, $sampaiTahun, $indikator, $propinsi, $kabupaten)
    {
        $queryBuilder = $this->createQueryBuilder('d');
        $queryBuilder->andWhere('d.indikator = :indikator');
        $queryBuilder->andWhere('d.propinsi = :propinsi');
        $queryBuilder->andWhere('d.kabupaten = :kabupaten');
        $queryBuilder->andWhere('d.tahun BETWEEN :from AND :to');
        $queryBuilder->setParameters(array(
            'indikator' => $indikator,
            'propinsi' => $propinsi,
            'kabupaten' => $kabupaten,
            'from' => $dariTahun,
            'to' => $sampaiTahun,
        ));

        return $queryBuilder->getQuery()->getResult();
    }

    public function findByIndikatorPropinsiSummary($dariTahun, $sampaiTahun, $indikator, $propinsi)
    {
        $queryBuilder = $this->createQueryBuilder('d');
        $queryBuilder->andWhere('d.indikator = :indikator');
        $queryBuilder->andWhere('d.propinsi = :propinsi');
        $queryBuilder->andWhere('d.tahun BETWEEN :from AND :to');
        $queryBuilder->setParameters(array(
            'indikator' => $indikator,
            'propinsi' => $propinsi,
            'from' => $dariTahun,
            'to' => $sampaiTahun,
        ));

        return $queryBuilder->getQuery()->getResult();
    }

    public function findByIndikatorSummary($dariTahun, $sampaiTahun, $indikator)
    {
        $queryBuilder = $this->createQueryBuilder('d');
        $queryBuilder->andWhere('d.indikator = :indikator');
        $queryBuilder->andWhere('d.tahun BETWEEN :from AND :to');
        $queryBuilder->setParameters(array(
            'indikator' => $indikator,
            'from' => $dariTahun,
            'to' => $sampaiTahun,
        ));

        return $queryBuilder->getQuery()->getResult();
    }
}
