<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api/wilayah")
 *
 * Class KabupatenApiController
 * @package AppBundle\Controller\Api
 **/
class WilayahApiController extends ApiController
{
    /**
     * @Route("/{node}/{id}/{data}", name="api_wilayah_find", defaults={"data" = "current"}, options={"exposed" = true})
     * @Method("GET")
     *
     * @param string $node
     * @param integer $id
     * @param string $data
     * @throws NotFoundHttpException
     * @return Response
     */
    public function findAction($node, $id, $data)
    {
        $entityAlias = $this->container->get('males.guesser')->initialize($this)->getEntityAlias();
        $em = $this->getDoctrine();
        $repository = $em->getRepository($entityAlias);

        if ('current' !== $data) {
            switch ($node) {
                case 'kabupaten':
                    $entity = $repository->findKabupatenByPropinsi($id);
                    break;
                case 'kecamatan':
                    $entity = $repository->findKecamatanByKabupaten($id);
                    break;
                default:
                    $entity = $repository->findKelurahanByKecamatan($id);
                    break;
            }
        } else {
            switch ($node) {
                case 'propinsi':
                    $entity = $repository->findPropinsi($id);
                    break;
                case 'kabupaten':
                    $entity = $repository->findKabupaten($id);
                    break;
                case 'kecamatan':
                    $entity = $repository->findKecamatan($id);
                    break;
                default:
                    $entity = $repository->findKelurahan($id);
                    break;
            }
        }

        if (! $entity) {
            throw new NotFoundHttpException('Data not found.');
        }

        return new Response($this->serialize($entity, array('list')));
    }
}