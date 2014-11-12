<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Form;

use Ihsan\MalesBundle\Form\AbstractFormFilter;

class IndikatorFilterType extends AbstractFormFilter
{
    public function getName()
    {
        return 'indikator_filter';
    }
}