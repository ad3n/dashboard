<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/kabupaten")
 **/
class KabupatenApiController extends ApiController
{
    const ENTITY_CLASS_NAME = 'AppBundle\\Entity\\Wilayah';

    /**
     * @Route("/find/{codePropinsi}", name="api_kabupaten_find", options={"expose"=true})
     * @Method({"GET"})
     *
     * @param $codePropinsi
     * @throws NotFoundHttpException
     * @return \Symfony\Component\HttpFoundation\Response
     **/
    public function find($codePropinsi)
    {
        $repository = $this->getDoctrine()->getRepository($this->getEntityAlias(self::ENTITY_CLASS_NAME));

        $entity = $repository->findPropinsi($codePropinsi);

        if (! $entity) {
            throw new NotFoundHttpException('Data not found.');
        }

        return new Response($this->serialize($entity, array('list')));
    }

    /**
     * @Route("/kecamatan/find/{id}", name="api_kabupaten_find_kecamatan", options={"expose"=true})
     * @Method({"GET"})
     *
     * @param $id
     * @throws NotFoundHttpException
     * @return \Symfony\Component\HttpFoundation\Response
     **/
    public function findKecamatanByKabupaten($id)
    {
        $repository = $this->getDoctrine()->getRepository($this->getEntityAlias(self::ENTITY_CLASS_NAME));

        $entity = $repository->findKecamatanByKabupaten($id);

        if (! $entity) {
            throw new NotFoundHttpException('Data not found.');
        }

        return new Response($this->serialize($entity, array('list')));
    }
} 