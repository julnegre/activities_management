<?php

namespace Jng\ActivityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Jng\ActivityBundle\Form\ActivityType;

use Jng\ActivityBundle\Entity\Activity;

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
    public function listAction()
    {
       return array("activities" => $this->getDoctrine()
        ->getRepository('JngActivityBundle:Activity')->findAll());

    }    
    
     /**
     * @Route("/today", defaults={"name"="World"}),
     * @Template()
     */
    public function addAction()
    {
      
        $activity = new Activity();
        
        $form = $this->createForm(new ActivityType(), $activity);
        
        return $this->render('JngActivityBundle:Entry:new.html.twig', array(
            'form' => $form->createView(),
        ));
        
    }
    
}
