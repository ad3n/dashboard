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
        parent::__construct($container, $formType, $entity);
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
        return parent::indexAction();
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