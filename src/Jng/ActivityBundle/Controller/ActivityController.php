<?php

namespace Jng\ActivityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Jng\ActivityBundle\Entity\Activity;
use Jng\ActivityBundle\Form\ActivityType;

/**
 * Activity controller.
 *
 */
class ActivityController extends Controller
{

    /**
     * Lists all Activity entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JngActivityBundle:Activity')->findAll();

        return $this->render('JngActivityBundle:Activity:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Activity entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Activity();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('activity_show', array('id' => $entity->getId())));
        }

        return $this->render('JngActivityBundle:Activity:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Activity entity.
    *
    * @param Activity $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Activity $entity)
    {
        $form = $this->createForm(new ActivityType(), $entity, array(
            'action' => $this->generateUrl('activity_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Activity entity.
     *
     */
    public function newAction()
    {
        $entity = new Activity();
        $form   = $this->createCreateForm($entity);

        return $this->render('JngActivityBundle:Activity:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Activity entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JngActivityBundle:Activity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Activity entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JngActivityBundle:Activity:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Activity entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JngActivityBundle:Activity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Activity entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JngActivityBundle:Activity:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Activity entity.
    *
    * @param Activity $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Activity $entity)
    {
        $form = $this->createForm(new ActivityType(), $entity, array(
            'action' => $this->generateUrl('activity_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Activity entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JngActivityBundle:Activity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Activity entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('activity_edit', array('id' => $id)));
        }

        return $this->render('JngActivityBundle:Activity:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Activity entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('JngActivityBundle:Activity')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Activity entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('activity'));
    }

    /**
     * Creates a form to delete a Activity entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('activity_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
