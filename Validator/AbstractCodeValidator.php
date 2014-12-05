<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Validator;

use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Translation\TranslatorInterface;

abstract class AbstractCodeValidator extends  ConstraintValidator
{
    protected $class;

    protected $manager;

    protected $translator;

    public function __construct($class, ObjectManager $manager, TranslatorInterface $translator)
    {
        $this->class = $class;
        $this->manager = $manager;
        $this->translator = $translator;
    }

    public function validate($object, Constraint $constraint)
    {
        if ($this->manager->getRepository($this->class)->findOneBy(array('code' => $object->getCode())) && null === $object->getId()) {

            $this->context->buildViolation($this->translator->trans('form.error.exist', array('%value%' => $object->getCode()), 'AppBundle'))
                ->addViolation()
            ;
        }
    }
}