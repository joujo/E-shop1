<?php

namespace Fidelisation\FidelisationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * CarteFidelite controller.
 *
 */

class CartefideliteController extends Controller
{
    /***
     *
     * Lists all CarteFidelite entities.
     *
     ***/
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FidelisationBundle:CarteFidelite')->findAll();
        $entities = $this->get('knp_paginator')->paginate($entities, $this->get('request')->query->get('page', 1), 1);

        return $this->render('FidelisationBundle:CarteFidelite:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /***
     *
     * Creates a new CarteFidelite entity.
     *
     ***/
    public function createAction(Request $request)
    {
        $entity = new CarteFidelite();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'successajout',
                'ajout avec succées'
            );

            return $this->redirect($this->generateUrl('cartefidelite'));
        }

        return $this->render('FidelisationBundle:CarteFidelite:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /***
     * Creates a form to create a CarteFidelite entity.
     *
     * @param CarteFidelite $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     ***/
    private function createCreateForm(CarteFidelite $entity)
    {
        $form = $this->createForm(new CarteFideliteType(), $entity, array(
            'action' => $this->generateUrl('cartefidelite_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter','attr' => array('class' => 'btn btn-block btn-success')));

        return $form;
    }

    /***
     * 
     * Displays a form to create a new CarteFidelite entity.
     *
     ***/
    public function newAction()
    {
        $entity = new CarteFidelite();
        $form   = $this->createCreateForm($entity);

        return $this->render('FidelisationBundle:CarteFidelite:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /***
     * 
     * Finds and displays a CarteFidelite entity.
     *
     ***/
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FidelisationBundle:CarteFidelite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CarteFidelite entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FidelisationBundle:CarteFidelite:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /***
     * 
     * Displays a form to edit an existing CarteFidelite entity.
     *
     ***/
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FidelisationBundle:CarteFidelite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CarteFidelite entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FidelisationBundle:CarteFidelite:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /***
     * Creates a form to edit a CarteFidelite entity.
     *
     * @param CarteFidelite $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(CarteFidelite $entity)
    {
        $form = $this->createForm(new CarteFideliteType(), $entity, array(
            'action' => $this->generateUrl('cartefidelite_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Mise à jour','attr' => array('class' => 'btn btn-block btn-success')));

        return $form;
    }
    /**
     * Edits an existing CarteFidelite entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FidelisationBundle:CarteFidelite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CarteFidelite entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'successMiseàjour',
                'Vos changements ont été sauvegardés!');

            return $this->redirect($this->generateUrl('cartefidelite'));
        }

        return $this->render('FidelisationBundle:CarteFidelite:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /***
     * 
     * Deletes a CarteFidelite entity.
     *
     ***/
    public function deleteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('FidelisationBundle:CarteFidelite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CarteFidelite entity.');
        }

        $em->remove($entity);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'successdelete',
            'success delete!');

        return $this->redirect($this->generateUrl('cartefidelite'));
    }

    /***
     * Creates a form to delete a CarteFidelite entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     ***/
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cartefidelite_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }

}
