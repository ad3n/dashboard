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
            'codeKecamatan' => 0,
            'codeKelurahan' => 0,
        ));
    }

    public function findKabupaten($codeKabupaten)
    {
        return $this->findOneBy(array(
            'codePropinsi' => '<>',
            'codeKabupaten' => $codeKabupaten,
            'codeKecamatan' => 0,
            'codeKelurahan' => 0,
        ));
    }

    public function findKecamatan($codeKecamatan)
    {
        return $this->findOneBy(array(
            'codePropinsi' => '<>',
            'codeKabupaten' => '<>',
            'codeKecamatan' => $codeKecamatan,
            'codeKelurahan' => 0,
        ));
    }

    public function findKelurahan($codeKelurahan)
    {
        return $this->findOneBy(array(
            'codePropinsi' => '<>',
            'codeKabupaten' => '<>',
            'codeKecamatan' => '<>',
            'codeKelurahan' => $codeKelurahan
        ));
    }

    public function findKabupatenByPropinsi($propinsiId)
    {
        $qb = $this->createQueryBuilder('a')
            ->andWhere('a.codePropinsi = :propinsi')
            ->andWhere('a.codeKabupaten <> 0')
            ->andWhere('a.codeKecamatan = 0')
            ->setParameter('propinsi', $this->convertIdToCode($propinsiId, 'propinsi'))
            ->getQuery()
            ->getResult()
        ;

        return new ArrayCollection($qb);
    }

    public function findKecamatanByKabupaten($kabupatenId)
    {
        $entity = $this->find($kabupatenId);

        $qb = $this->createQueryBuilder('a')
            ->andWhere('a.codePropinsi = :propinsi')
            ->andWhere('a.codeKabupaten = :kabupaten')
            ->andWhere('a.codeKecamatan <> 0')
            ->andWhere('a.codeKelurahan = 0')
            ->setParameter('propinsi', $entity->getCodePropinsi())
            ->setParameter('kabupaten', $this->convertIdToCode($kabupatenId, 'kabupaten'))
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
            ->setParameter('kecamatan', $this->convertIdToCode($kecamatanId, 'kecamatan'))
            ->getQuery()
            ->getResult()
        ;

        return new ArrayCollection($qb);
    }

    protected function convertIdToCode($id, $scope)
    {
        $entity = $this->find($id);

        return call_user_func(array($entity, sprintf('getCode%s', ucfirst($scope))));
    }
}