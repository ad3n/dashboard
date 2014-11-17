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
use Doctrine\Common\Collections\ArrayCollection;

class WilayahRepository extends EntityRepository
{
    public function findAllPropinsi()
    {
        $qb = $this->createQueryBuilder('a')
            ->andWhere('a.codePropinsi <> 0')
            ->andWhere('a.codeKabupaten = 0')
            ->andWhere('a.codeKecamatan = 0')
            ->andWhere('a.codeKelurahan = 0')
            ->getQuery()
            ->getResult()
        ;

        return new ArrayCollection($qb);
    }

    public function findPropinsi($codePropinsi)
    {
        return $this->findOneBy(array(
            'codePropinsi' => $codePropinsi,
            'codeKabupaten' => 0,
        ));
    }

    public function findKabupaten($codeKabupaten)
    {
        return $this->findOneBy(array(
            'codeKabupaten' => $codeKabupaten,
            'codeKecamatan' => 0,
        ));
    }

    public function findKecamatan($codeKecamatan)
    {
        return $this->findOneBy(array(
            'codeKecamatan' => $codeKecamatan,
            'codeKelurahan' => 0,
        ));
    }

    public function findKelurahan($codeKelurahan)
    {
        return $this->findOneBy(array('codeKelurahan' => $codeKelurahan));
    }

    public function findKabupatenByPropinsi($propinsiId)
    {
        $qb = $this->createQueryBuilder('a')
            ->andWhere('a.codePropinsi = :propinsi')
            ->andWhere('a.codeKabupaten <> 0')
            ->andWhere('a.codeKecamatan = 0')
            ->setParameter('propinsi', $propinsiId)
            ->getQuery()
            ->getResult()
        ;

        return new ArrayCollection($qb);
    }

    public function findKecamatanByKabupaten($kabupatenId)
    {
        $qb = $this->createQueryBuilder('a')
            ->andWhere('a.codeKabupaten = :kabupaten')
            ->andWhere('a.codeKecamatan <> 0')
            ->andWhere('a.codeKelurahan = 0')
            ->setParameter('kabupaten', $kabupatenId)
            ->getQuery()
            ->getResult()
        ;

        return new ArrayCollection($qb);
    }

    public function findKelurahanByKecamatan($kecamatanId)
    {
        $qb = $this->createQueryBuilder('a')
            ->andWhere('a.codeKecamatan = :kecamatan')
            ->andWhere('a.codeKelurahan <> 0')
            ->setParameter('kecamatan', $kecamatanId)
            ->getQuery()
            ->getResult()
        ;

        return new ArrayCollection($qb);
    }
}