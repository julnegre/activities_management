<?php

namespace Jng\ActivityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Jng\ActivityBundle\Entity\Business;
use Jng\ActivityBundle\Form\BusinessType;
use Jng\ActivityBundle\Form\SearchType;

/**
 * Business controller.
 *
 */
class BusinessController extends Controller
{

    /**
     * Lists all Business entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = $this->get('security.context')->getToken()->getUser();
        
        $entities = $em->getRepository('JngActivityBundle:Business')->findBy(array("user"=>$user));
        
        $deleteForms = array();
        foreach ($entities as $entity) {
            $deleteForms[$entity->getId()] = $this->createDeleteForm($entity->getId())->createView();
        }
        
        // search Form
        $searchForm = $this->createForm(new SearchType('Jng\ActivityBundle\Entity\Business'), null);

        
        return $this->render('JngActivityBundle:Business:index.html.twig', array(
            'entities' => $entities,
            'deleteForms' => $deleteForms,
            'searchForm' => $searchForm->createView()
        ));
    }
    /**
     * Creates a new Business entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Business();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('business', array('id' => $entity->getId())));
        }

        return $this->render('JngActivityBundle:Business:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Business entity.
    *
    * @param Business $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Business $entity)
    {
        $entity->setUser($this->getUser());
        
        $form = $this->createForm(new BusinessType(), $entity, array(
            'action' => $this->generateUrl('business_create'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Business entity.
     *
     */
    public function newAction()
    {
        $entity = new Business();
        $form   = $this->createCreateForm($entity);

        return $this->render('JngActivityBundle:Business:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Business entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JngActivityBundle:Business')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Business entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JngActivityBundle:Business:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Business entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JngActivityBundle:Business')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Business entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JngActivityBundle:Business:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Business entity.
    *
    * @param Business $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Business $entity)
    {
        $form = $this->createForm(new BusinessType(), $entity, array(
            'action' => $this->generateUrl('business_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Business entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JngActivityBundle:Business')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Business entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('business', array('id' => $id)));
        }

        return $this->render('JngActivityBundle:Business:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Business entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('JngActivityBundle:Business')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Business entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('business'));
    }

    /**
     * Creates a form to delete a Business entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('business_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
