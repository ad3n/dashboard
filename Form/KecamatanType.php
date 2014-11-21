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
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Ihsan\MalesBundle\Form\AbstractType;
use Ihsan\MalesBundle\Guesser\BundleGuesserInterface;
use AppBundle\Form\DataTransformer\WilayahToCodeTransformer;

class KecamatanType extends AbstractType
{
    const FORM_NAME = 'kecamatan';

    protected $objectManager;

    public function __construct(BundleGuesserInterface $guesser, ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
        parent::__construct($guesser);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $propinsi = new WilayahToCodeTransformer($this->objectManager, $this->guesser->getEntityAlias(), 'propinsi');
        $builder
            ->add($builder->create(
                    'code_propinsi', 'xentity', array(
                        'label' => 'form.label.propinsi',
                        'class' => $this->guesser->getEntityClass(),
                        'empty_value' => 'form.select.empty',
                        'property' => 'name',
                        'action' => 'api_propinsi_find_kabupaten',
                        'target' => array(
                            'type' => 'class',
                            'selector' => 'kabupaten',
                            'handler' =>
<<<EOD
data = JSON.parse(data);
html = '';
jQuery.each(data, function(key, value) {
    html = html + '<option value="' + value.id + '">' + value.name + '</option>';
});
jQuery('%target-selector%').empty().append(html);
EOD

                        ),
                        'query_builder' => function(EntityRepository $er ) {

                            return $er->createQueryBuilder('a')
                                ->andWhere('a.codePropinsi <> 0')
                                ->andWhere('a.codeKabupaten = 0')
                                ->andWhere('a.codeKecamatan = 0')
                                ->andWhere('a.codeKelurahan = 0');
                        }
                    )
                )->addModelTransformer($propinsi)
            )
            ->add('code_kabupaten', 'choice', array(
                'label' => 'form.label.kabupaten',
                'attr' => array(
                    'class' => 'kabupaten'
                )
            ))
            ->add('code_kecamatan', 'text', array(
                'label' => 'form.label.code',
            ))
            ->add('name', 'text', array(
                'label' => 'form.label.name',
            ))
        ;

        $builder->addEventListener(FormEvents::PRE_SUBMIT,
            function (FormEvent $event) use ($builder) {
                $form = $event->getForm();
                $data = $event->getData();

                $form->remove('code_kabupaten');
                $form->add('code_kabupaten', 'kabupaten', array(
                    'class' => $this->guesser->getEntityClass(),
                    'query_builder' => function(EntityRepository $er ) use ($data) {
                        $propinsi = $er->find($data['code_propinsi']);

                        return $er->createQueryBuilder('a')
                            ->andWhere('a.codePropinsi = :propinsi')
                            ->andWhere('a.codeKabupaten <> 0')
                            ->andWhere('a.codeKecamatan = 0')
                            ->andWhere('a.codeKelurahan = 0')
                            ->setParameter('propinsi', $propinsi->getCodePropinsi())
                            ;
                    },
                ));
            }
        );

        $builder->addEventListener(FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($builder) {
                $form = $event->getForm();
                $data = $event->getData();

                if (null !== $data->getId()) {
                    $form->remove('code_kabupaten');
                    $form->add('code_kabupaten', 'kabupaten', array(
                        'class' => $this->guesser->getEntityClass(),
                        'query_builder' => function(EntityRepository $er ) use ($data) {

                            return $er->createQueryBuilder('a')
                                ->andWhere('a.codePropinsi = :propinsi')
                                ->andWhere('a.codeKabupaten <> 0')
                                ->andWhere('a.codeKecamatan = 0')
                                ->andWhere('a.codeKelurahan = 0')
                                ->setParameter('propinsi', $data->getCodePropinsi())
                                ;
                        },
                        'label' => 'form.label.kabupaten',
                        'attr' => array(
                            'class' => 'kabupaten'
                        )
                    ));
                }
            }
        );
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