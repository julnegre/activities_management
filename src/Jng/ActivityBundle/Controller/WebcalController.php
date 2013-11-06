<?php

namespace Jng\ActivityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Jng\ActivityBundle\Entity\ActivityStorage;


/**
 * ActivityStorage controller.
 *
 */
class WebcalController extends Controller
{

    /**
     * Lists all ActivityStorage entities.
     *
     */
    public function indexAction($id)
    {

      $em = $this->getDoctrine()->getManager();
      
      $query = $em->createQuery(
        'SELECT j as token FROM JngUserBundle:User j WHERE MD5(j.emailCanonical) = :token'
      )->setParameter('token', $id);
      $entities = $query->getResult();
      $user = $entities[0];

      $entities = $em->getRepository('JngActivityBundle:ActivityStorage')
                ->findBy(array("user"=>$user), array("start"=>"ASC"));
       
      $content = $this->renderView('JngActivityBundle:Webcal:index.html.twig', array(
            'entities' => $entities
        ));

        $response = new Response();
        $response->setContent($content);
        $response->headers->set('Content-Type', 'text/calendar; charset=utf-8');
        $response->headers->set('Content-Disposition', 'inline; filename=activity.ics');

        return $response;
 
    }
   
}
