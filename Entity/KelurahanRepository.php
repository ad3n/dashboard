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

class KelurahanRepository extends EntityRepository
{
    public function findByKecamatan($kecamatan)
    {
        return $this->findOneBy(array('kecamatan' => $kecamatan));
    }

    public function findByCode($code)
    {
        return $this->findOneBy(array('code' => $code));
    }
}
