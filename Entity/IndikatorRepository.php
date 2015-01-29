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

class IndikatorRepository extends EntityRepository
{
    public function getChildIndikatorByParentCode($parentCode)
    {
        $shortCode = substr($parentCode, 0, 2);

        $qb = $this->createQueryBuilder('i');
        $qb->andWhere('i.code LIKE :short')
            ->andWhere('i.code <> :parent')
            ->andWhere('i.code <> :super')
            ->addOrderBy('i.code')
            ->setParameter('short', sprintf('%%%s%%', $shortCode))
            ->setParameter('super', sprintf('%s00', $shortCode))
            ->setParameter('parent', $parentCode);

        return $qb->getQuery()->getResult();
    }
}