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

class KecamatanRepository extends EntityRepository
{
    public function findByKabupaten($kabupaten)
    {
        return $this->findOneBy(array('kabupaten' => $kabupaten));
    }

    public function findByCode($code)
    {
        return $this->findOneBy(array('code' => $code));
    }
}
