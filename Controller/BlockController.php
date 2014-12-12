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
 * @Route("/admin/block", service="app.controller.block")
 **/
class BlockController extends CrudController
{
    public function __construct(ContainerInterface $container, AbstractType $formType, EntityInterface $entity)
    {
        parent::__construct($container, $formType, $entity);
    }

    /**
     * @Route("/new/", name="block_create")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_READER')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm($this->formType, $this->entity);

        if ($request->isMethod('post')) {
            $em = $this->getDoctrine()->getManager();
            $form->handleRequest($request);

            if (! $form->isValid()) {

                return $this->render(sprintf('%s:%s:new.html.twig', $this->guesser->getBundleAlias(), $this->guesser->getIdentity()), array(
                    'form' => $form->createView(),
                ));
            }

            $block = $form->getData();
            $block->setUser($this->getUser());

            $em->persist($block);
            $em->flush();

            $session = $this->container->get('session');
            $session->getFlashBag()->set(Constant::MESSAGE_SAVE, $this->get('translator')->trans(Constant::MESSAGE_SAVE, array('data' => $form->getData()->getName()), $this->container->getParameter('bundle')));

            return $this->redirect($this->generateUrl(sprintf('%s_index', strtolower($this->guesser->getIdentity()))));
        }

        return $this->render(sprintf('%s:%s:new.html.twig', $this->guesser->getBundleAlias(), $this->guesser->getIdentity()), array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/", name="block_index")
     * @Method({"GET"})
     * @Security("has_role('ROLE_READER')")
     *
     * @param bool $toUpperFilter
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($toUpperFilter = true)
    {
        return parent::indexAction($toUpperFilter);
    }

    /**
     * @Route("/{id}/edit", name="block_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_READER')")
     *
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id)
    {
        return parent::editAction($id);
    }

    /**
     * @Route("/{id}/delete", name="block_delete")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_READER')")
     *
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($id)
    {
        return parent::deleteAction($id);
    }

    /**
     * @Route("/{id}/show", name="block_show")
     * @Method({"GET"})
     * @Security("has_role('ROLE_READER')")
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        return parent::showAction($id);
    }
} 