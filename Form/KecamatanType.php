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
        $builder
            ->add(
                'propinsi', 'xentity', array(
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
EOD
                )
            ))
            ->add('kabupaten', 'choice', array(
                'label' => 'form.label.kabupaten',
                'attr' => array(
                    'class' => 'kabupaten'
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
                $data = $event->getData();
                unset($data['propinsi']);

                $form->remove('kabupaten');
                $form->add('kabupaten', 'entity', array(
                    'class' => 'AppBundle\\Entity\\Kabupaten',
                ));
            }
        );

        $builder->addEventListener(FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($builder) {
                $form = $event->getForm();
                $data = $event->getData();

                if (null !== $data->getId()) {
                    $form->remove('kabupaten');
                    $form->add('kabupaten', 'entity', array(
                        'class' => 'AppBundle\\Entity\\Kabupaten',
                        'label' => 'form.label.kabupaten',
                        'attr' => array(
                            'class' => 'kabupaten'
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
                    $form->get('propinsi')->setData($data->getKabupaten()->getPropinsi());
                }
            });
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