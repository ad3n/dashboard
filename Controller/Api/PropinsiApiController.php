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
 * @Route("/propinsi")
 **/
class PropinsiApiController extends ApiController
{
    /**
     * @Route("/find/{codePropinsi}", name="api_propinsi_find", options={"expose"=true})
     * @Method({"GET"})
     *
     * @param $codePropinsi
     * @throws NotFoundHttpException
     * @return \Symfony\Component\HttpFoundation\Response
     **/
    public function find($codePropinsi)
    {
        $repository = $this->getDoctrine()->getRepository($this->getEntityAlias('AppBundle\\Entity\\Propinsi'));

        $entity = $repository->findByCode($codePropinsi);

        if (! $entity) {
            throw new NotFoundHttpException('Data not found.');
        }

        return new Response($this->serialize($entity, array('list')));
    }

    /**
     * @Route("/find/kabupaten/{id}", name="api_propinsi_find_kabupaten", options={"expose"=true})
     * @Method({"GET"})
     *
     * @param $id
     * @throws NotFoundHttpException
     * @return \Symfony\Component\HttpFoundation\Response
     **/
    public function findKabupatenByPropinsi($id)
    {
        $repository = $this->getDoctrine()->getRepository($this->getEntityAlias('AppBundle\\Entity\\Kabupaten'));

        $entity = $repository->findBy(array('propinsi' => $id));

        if (! $entity) {
            throw new NotFoundHttpException('Data not found.');
        }

        return new Response($this->serialize($entity, array('list')));
    }
} 