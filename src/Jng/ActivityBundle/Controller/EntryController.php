<?php

namespace Jng\ActivityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Jng\ActivityBundle\Form\ActivityForm;
use Jng\ActivityBundle\Form\ActivityStorageForm;
use Jng\ActivityBundle\Form\BusinessForm;
use Jng\ActivityBundle\Form\CustomerForm;
use Jng\ActivityBundle\Form\TaskForm;


use Jng\ActivityBundle\Entity\Activity;
use Jng\ActivityBundle\Entity\ActivityStorage;
use Jng\ActivityBundle\Entity\Business;
use Jng\ActivityBundle\Entity\Customer;
use Jng\ActivityBundle\Entity\Task;

/**
 * @Route("/activity/entry")
 */
class EntryController extends Controller
{
    /**
     * @Route("/login", name="_activity_login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            'last_username' => $request->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );
    }

    /**
     * @Route("/login_check", name="_security_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/logout", name="_activity_logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/today", defaults={"name"="World"}),
     * @Template()
     */
    public function todayAction()
    {
        return array('name' => time());
    }

    /**
     * @Route("/today", defaults={"name"="World"}),
     * @Template()
     */
    public function listActivityAction()
    {
       return array("activities" => $this->getDoctrine()
        ->getRepository('JngActivityBundle:Activity')->findAll());

    }    
    
    public function listCustomerAction()
    {
       return array("customers" => $this->getDoctrine()
        ->getRepository('JngActivityBundle:Customer')->findAll());

    }  
    public function listBusinessAction()
    {
       return array("business" => $this->getDoctrine()
        ->getRepository('JngActivityBundle:Business')->findAll());

    }     
     /**
     * @Route("/today", defaults={"name"="World"}),
     * @Template()
     */
    public function addActivityAction(Request $request)
    {
      
        $activity = new Activity();
        $message = "";
        $form = $this->createForm(new ActivityForm(), $activity);
        

        if ($request->getMethod() == 'POST') 
        {
          $form->handleRequest($request);

          if ($form->isValid()) 
          {
            $em = $this->container->get('doctrine')->getManager();
            $em->persist($activity);
            $em->flush();
            $message='Activité ajoutée avec succès !';
          }
        }

        
        return $this->render('JngActivityBundle:Entry:new.activity.html.twig', array(
            'form' => $form->createView(),
            'message' => $message
        ));
        
    }
    public function addCustomerAction(Request $request)
    {
        $message = "";
        $activity = new Customer();
        $form = $this->createForm(new CustomerForm(), $activity);
        
        
        if ($request->getMethod() == 'POST') 
        {
          $form->handleRequest($request);

          if ($form->isValid()) 
          {
            $em = $this->container->get('doctrine')->getManager();
            $em->persist($activity);
            $em->flush();
            $message='Client ajouté avec succès !';
          }
        }
        
        
        return $this->render('JngActivityBundle:Entry:new.customer.html.twig', array(
            'form' => $form->createView(),
            'message' => $message
        ));
        
    }
    public function addActivityStorageAction(Request $request)
    {
        $message = "";
        $activity = new ActivityStorage();
        $form = $this->createForm(new ActivityStorageForm(), $activity);
        
        if ($request->getMethod() == 'POST') 
        {
          $form->handleRequest($request);

          if ($form->isValid()) 
          {
            $em = $this->container->get('doctrine')->getManager();
            $activity->setStart(new \DateTime());
            $em->persist($activity);
            $em->flush();
            $message='Activité réelle ajoutée avec succès !';
          }
        }        
        
        return $this->render('JngActivityBundle:Entry:new.activity.storage.html.twig', array(
            'form' => $form->createView(),
            'message' => $message
        ));
        
    }    
     public function addBusinessAction(Request $request)
    {
        $message = "";
        $activity = new Business();
        $form = $this->createForm(new BusinessForm(), $activity);
        
        if ($request->getMethod() == 'POST') 
        {
          $form->handleRequest($request);

          if ($form->isValid()) 
          {
            $em = $this->container->get('doctrine')->getManager();
            $em->persist($activity);
            $em->flush();
            $message='Affaire ajoutée avec succès !';
          }
        }   
        
        return $this->render('JngActivityBundle:Entry:new.business.html.twig', array(
            'form' => $form->createView(),
            'message' => $message
        ));
        
    }  
     public function addTaskAction(Request $request)
    {
        $message = "";
        $activity = new Task();
        $form = $this->createForm(new TaskForm(), $activity);
        
        if ($request->getMethod() == 'POST') 
        {
          $form->handleRequest($request);

          if ($form->isValid()) 
          {
            $em = $this->getDoctrine()->getManager();
            $em->persist($activity);
            $em->flush();
            $message='Tache ajoutée avec succès !';
          }
        }   
        
        return $this->render('JngActivityBundle:Entry:new.task.html.twig', array(
            'form' => $form->createView(),
            'message' => $message
        ));
        
    }     
}
