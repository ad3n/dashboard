<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Ihsan\MalesBundle\Controller\CrudController;
use Ihsan\MalesBundle\Form\AbstractType;
use Ihsan\MalesBundle\Entity\EntityInterface;
use Ihsan\MalesBundle\IhsanMalesBundle as Constant;

/**
 * @Route("/admin/kelurahan", service="app.controller.kelurahan")
 **/
class KelurahanController extends CrudController
{
    public function __construct(ContainerInterface $container, AbstractType $formType, EntityInterface $entity)
    {
        parent::__construct($container, $formType, $entity, 'AppBundle\Entity\Wilayah');
    }

    /**
     * @Route("/new/", name="kelurahan_create")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        return parent::newAction($request);
    }

    /**
     * @Route("/", name="kelurahan_index")
     * @Method({"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param bool $toUpperFilter
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($toUpperFilter = true)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository($this->guesser->getEntityAlias());
        $request = $this->container->get('request');

        /**
         * @var QueryBuilder
         **/
        $qb = $repo->createQueryBuilder('o')
            ->select('o')
            ->andWhere('o.codePropinsi <> 0')
            ->andWhere('o.codeKabupaten <> 0')
            ->andWhere('o.codeKecamatan <> 0')
            ->andWhere('o.codeKelurahan <> 0')
            ->addOrderBy('o.codeKelurahan', 'DESC');
        $filter = $toUpperFilter ? strtoupper($request->query->get('filter')) : $request->query->get('filter');

        if ($filter) {
            $qb->andWhere(sprintf('o.%s LIKE :filter', $this->entity->getFilter()))
                ->setParameter('filter', strtr('%filter%', array('filter' => $filter)));
        }

        $page = $request->query->get('page', 1);
        $paginator  = $this->container->get('knp_paginator');

        $pagination = $paginator->paginate(
            $qb,
            $page,
            Constant::RECORD_PER_PAGE
        );

        return $this->render(sprintf('%s:%s:list.html.twig', $this->guesser->getBundleAlias(), $this->guesser->getIdentity()),
            array(
                'data' => $pagination,
                'start' => ($page - 1) * Constant::RECORD_PER_PAGE,
                'filter' => $filter,
            )
        );
    }

    /**
     * @Route("/{id}/edit", name="kelurahan_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id)
    {
        return parent::editAction($id);
    }

    /**
     * @Route("/{id}/delete", name="kelurahan_delete")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($id)
    {
        return parent::deleteAction($id);
    }

    /**
     * @Route("/{id}/show", name="kelurahan_show")
     * @Method({"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        return parent::showAction($id);
    }
} 