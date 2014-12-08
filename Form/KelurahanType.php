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

class KelurahanType extends AbstractType
{
    const FORM_NAME = 'kelurahan';

    protected $objectManager;

    public function __construct(BundleGuesserInterface $guesser, ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
        parent::__construct($guesser);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('propinsi', 'xentity', array(
                'label' => 'form.label.propinsi',
                'class' => 'AppBundle\\Entity\\Propinsi',
                'empty_value' => 'form.select.empty',
                'property' => 'name',
                'action' => 'api_propinsi_find_kabupaten',
                'mapped' => false,
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
jQuery('%target-selector%').trigger('change');
EOD
                )
            ))
            ->add('kabupaten', 'xchoice', array(
                'label' => 'form.label.kabupaten',
                'action' => 'api_kabupaten_find_kecamatan',
                'attr' => array(
                    'class' => 'kabupaten'
                ),
                'mapped' => false,
                'target' => array(
                    'type' => 'class',
                    'selector' => 'kecamatan',
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
            ))
            ->add('kecamatan', 'choice', array(
                'label' => 'form.label.kecamatan',
                'attr' => array(
                    'class' => 'kecamatan'
                )
            ))
            ->add('code', 'text', array(
                'label' => 'form.label.code',
            ))
            ->add('name', 'text', array(
                'label' => 'form.label.name',
            ))
        ;

        $builder->addEventListener(FormEvents::PRE_SUBMIT,
            function (FormEvent $event) use ($builder) {
                $form = $event->getForm();

                $form->remove('kabupaten');
                $form->add('kabupaten', 'xentity', array(
                    'label' => 'form.label.kabupaten',
                    'action' => 'api_kabupaten_find_kecamatan',
                    'attr' => array(
                        'class' => 'kabupaten'
                    ),
                    'class' => 'AppBundle\\Entity\\Kabupaten',
                    'mapped' => false,
                    'target' => array(
                        'type' => 'class',
                        'selector' => 'kecamatan',
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
                ));

                $form->remove('kecamatan');
                $form->add('kecamatan', 'entity', array(
                    'class' => 'AppBundle\\Entity\\Kecamatan',
                ));
            }
        );

        $builder->addEventListener(FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($builder) {
                $form = $event->getForm();
                $data = $event->getData();

                if (null !== $data->getId()) {

                    $form->remove('kabupaten');
                    $form->add('kabupaten', 'xentity', array(
                        'label' => 'form.label.kabupaten',
                        'action' => 'api_kabupaten_find_kecamatan',
                        'attr' => array(
                            'class' => 'kabupaten'
                        ),
                        'class' => 'AppBundle\\Entity\\Kabupaten',
                        'mapped' => false,
                        'target' => array(
                            'type' => 'class',
                            'selector' => 'kecamatan',
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
                    ));

                    $form->remove('kecamatan');
                    $form->add('kecamatan', 'entity', array(
                        'class' => 'AppBundle\\Entity\\Kecamatan',
                        'label' => 'form.label.kecamatan',
                        'attr' => array(
                            'class' => 'kecamatan'
                        )
                    ));
                }
            }
        );

        $builder->addEventListener(FormEvents::POST_SET_DATA,
            function(FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();

                if (null !== $data->getId()) {
                    $form->get('propinsi')->setData($data->getKecamatan()->getKabupaten()->getPropinsi());

                    $form->remove('kabupaten');
                    $form->add('kabupaten', 'xentity', array(
                        'label' => 'form.label.kabupaten',
                        'action' => 'api_kabupaten_find_kecamatan',
                        'attr' => array(
                            'class' => 'kabupaten'
                        ),
                        'class' => 'AppBundle\\Entity\\Kabupaten',
                        'mapped' => false,
                        'target' => array(
                            'type' => 'class',
                            'selector' => 'kecamatan',
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