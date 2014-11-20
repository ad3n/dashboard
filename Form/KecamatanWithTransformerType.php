<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\DataTransformer\WilayahToCodeTransformer;

class KecamatanWithTransformerType extends AbstractType
{
    protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $kabupatenTransformer = new WilayahToCodeTransformer($this->objectManager, 'AppBundle\Entity\Wilayah', 'kecamatan');
        $builder->addModelTransformer($kabupatenTransformer);
    }

    public function getParent()
    {
        return 'entity';
    }

    public function getName()
    {
        return 'kecamatan';
    }
} 