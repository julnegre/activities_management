<?php

namespace Jng\ActivityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Jng\ActivityBundle\Entity\ActivityStorage;
use Jng\ActivityBundle\Form\ActivityStorageType;

/**
 * ActivityStorage controller.
 *
 */
class ActivityStorageController extends Controller
{

    /**
     * Lists all ActivityStorage entities.
     *
     */
    public function indexAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JngActivityBundle:ActivityStorage')->findAll();
        
        $deleteForms = array();
        foreach ($entities as $entity) {
            $deleteForms[$entity->getId()] = $this->createDeleteForm($entity->getId())->createView();
        }

        $editForms = array();
        foreach ($entities as $entity) {
            $editForms[$entity->getId()] = $this->createEditForm($entity)->createView();
        }
        
        return $this->render('JngActivityBundle:ActivityStorage:index.html.twig', array(
            'entities' => $entities,
            'deleteForms' => $deleteForms,
            'stopForms' => $editForms,
            'user'
        ));
    }
    /**
     * Creates a new ActivityStorage entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ActivityStorage();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('activitystorage', array('id' => $entity->getId())));
        }

        return $this->render('JngActivityBundle:ActivityStorage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a ActivityStorage entity.
    *
    * @param ActivityStorage $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ActivityStorage $entity)
    {
        $form = $this->createForm(new ActivityStorageType(), $entity, array(
            'action' => $this->generateUrl('activitystorage_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ActivityStorage entity.
     *
     */
    public function newAction()
    {
        $entity = new ActivityStorage();
        $form   = $this->createCreateForm($entity);

        return $this->render('JngActivityBundle:ActivityStorage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ActivityStorage entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JngActivityBundle:ActivityStorage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActivityStorage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JngActivityBundle:ActivityStorage:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing ActivityStorage entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JngActivityBundle:ActivityStorage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActivityStorage entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JngActivityBundle:ActivityStorage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ActivityStorage entity.
    *
    * @param ActivityStorage $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ActivityStorage $entity)
    {
        $form = $this->createForm(new ActivityStorageType(), $entity, array(
            'action' => $this->generateUrl('activitystorage_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ActivityStorage entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JngActivityBundle:ActivityStorage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActivityStorage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('activitystorage_edit', array('id' => $id)));
        }

        return $this->render('JngActivityBundle:ActivityStorage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ActivityStorage entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('JngActivityBundle:ActivityStorage')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ActivityStorage entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('activitystorage'));
    }

    /**
     * Creates a form to delete a ActivityStorage entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('activitystorage_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    public function stopAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JngActivityBundle:ActivityStorage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActivityStorage entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            $entity->setEndValue();
            $em->persist($entity);
            
            $em->flush();

            return $this->redirect($this->generateUrl('activitystorage', array('id' => $id)));
        }

    }
}
