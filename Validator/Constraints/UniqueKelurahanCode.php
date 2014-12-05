<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Validator\Constraints;

/**
 * @Annotation
 **/
class UniqueKelurahanCode extends UniqueCodeConstraint
{
    public function validatedBy()
    {
        return 'code_kelurahan_validator';
    }
} 