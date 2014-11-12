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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api/indikator")
 *
 * Class IndikatorApiController
 * @package AppBundle\Controller\Api
 **/
class IndikatorApiController extends ApiController
{
    /**
     * @Route("/tree/{node}", name="api_indikator_tree", defaults={"node" = "root"})
     * @Method("GET")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     *
     * @param $node
     * @throws NotFoundHttpException
     * @return Response
     **/
    public function treeAction($node)
    {
        $entityAlias = $this->container->get('males.guesser')->initialize($this)->getEntityAlias();
        $em = $this->getDoctrine();

        if ('root' === $node) {
            $entity = $em->getRepository($entityAlias)->findBy(array('parent' => null));
        } else {
            $entity = $em->getRepository($entityAlias)->findBy(array('parent' => $node));
        }

        if (! $entity) {
            throw new NotFoundHttpException('Indikator not found.');
        }

        return new Response($this->serialize($entity, array('tree')));
    }
} 