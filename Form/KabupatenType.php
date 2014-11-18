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
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Ihsan\MalesBundle\Form\AbstractType;
use Ihsan\MalesBundle\Guesser\BundleGuesserInterface;
use AppBundle\Form\DataTransformer\WilayahToCodeTransformer;

class KabupatenType extends AbstractType
{
    const FORM_NAME = 'user';

    protected $objectManager;

    public function __construct(BundleGuesserInterface $guesser, ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
        parent::__construct($guesser);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new WilayahToCodeTransformer($this->objectManager, $this->guesser->getEntityAlias(), 'propinsi');
        $builder
            ->add($builder->create(
                'code_propinsi', 'entity', array(
                    'label' => 'form.label.propinsi',
                    'class' => $this->guesser->getEntityClass(),
                    'empty_value' => 'form.select.empty',
                    'property' => 'name',
                    'query_builder' => function(EntityRepository $er ) {
                        return $er->createQueryBuilder('a')
                            ->andWhere('a.codePropinsi <> 0')
                            ->andWhere('a.codeKabupaten = 0')
                            ->andWhere('a.codeKecamatan = 0')
                            ->andWhere('a.codeKelurahan = 0');
                        }
                    )
                )->addModelTransformer($transformer)
            )
            ->add('code_kabupaten', 'text', array(
                'label' => 'form.label.code',
            ))
            ->add('name', 'text', array(
                'label' => 'form.label.name',
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->guesser->getEntityClass(),
            'translation_domain' => $this->guesser->getBundleAlias(),
            'intention'  => self::FORM_NAME,
        ));
    }

    public function getName()
    {
        return self::FORM_NAME;
    }
}