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
 * @Route("/api/user")
 *
 * Class UserApiController
 * @package AppBundle\Controller\Api
 **/
class UserApiController extends ApiController
{
    /**
     * @Route("/find/{id}", name="api_user_find_by_id")
     * @Method("GET")
     *
     * @param $id
     * @throws NotFoundHttpException
     * @return Response
     **/
    public function find($id)
    {
        $entityAlias = $this->container->get('males.guesser')->initialize($this)->getEntityAlias();
        $em = $this->getDoctrine();
        $entity = $em->getRepository($entityAlias)->find($id);

        if (! $entity) {
            throw new NotFoundHttpException('User not found.');
        }

        return new Response($this->serialize($entity, array('list')));
    }
}