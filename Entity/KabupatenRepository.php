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

class KabupatenRepository extends EntityRepository
{
    public function findByPropinsi($propinsi)
    {
        return $this->findOneBy(array('propinsi' => $propinsi));
    }

    public function findByCode($code)
    {
        return $this->findOneBy(array('code' => $code));
    }
}
