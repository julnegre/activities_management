<?php

namespace Jng\ActivityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jng\ActivityBundle\Entity\ActivityStorage;
use Jng\ActivityBundle\Form\ActivityStorageType;
use Doctrine\ORM\Query;
use Jng\ActivityBundle\Entity\Repository\ActivityStorageRepository;

/**
 * ActivityStorage controller.
 *
 */
class ActivityStorageController extends Controller {

    /**
     * Lists all ActivityStorage entities.
     *
     */
    public function indexAction(Request $request) {
        $user = $this->container->get('security.context')->getToken()->getUser();

        if( $request->get("d1") != "" ){
            $dd1 = $request->get("d1");//dd/MM/YYYY
            $dd2 = $request->get("d2");
            //put in session
            $d1 = date_format(date_create_from_format('d/m/Y', $dd1), 'Y-m-d');
            $d2 = date_format(date_create_from_format('d/m/Y', $dd2), 'Y-m-d');
            $d2 .= " 23:59:59";
        } else {
            $d1 = date("Y-m")."-01 00:00:00";
            $d2 = date("Y-m-t")." 23:59:59";
        }
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('JngActivityBundle:ActivityStorage')
                ->getActivitiesForUser($user, $d1, $d2);
        
        $deleteForms = array();
        foreach ($entities as $entity) {
            $deleteForms[$entity->getId()] = $this->createDeleteForm($entity->getId())->createView();
        }

        $editForms = array();
        foreach ($entities as $entity) {
            $editForms[$entity->getId()] = $this->createEditForm($entity)->createView();
        }

        $ical = "";
        if ($user != "anon.")
        // ical token
            $ical = md5($user->getSalt() . $user->getEmailCanonical());

        return $this->render('JngActivityBundle:ActivityStorage:index.html.twig', array(
                    'entities' => $entities,
                    'deleteForms' => $deleteForms,
                    'stopForms' => $editForms,
                    'ical' => $ical,
                    'd1' => $d1,    
                    'd2' => $d2
        ));
    }

    /**
     * 
     */
    public function updatechartAction(Request $request) {

        $user = $this->container->get('security.context')->getToken()->getUser();

        if( $request->request->get("type") == "m" )
            $subquery = "(a.start between DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW())";
        else if( $request->request->get("type") == "y" )
            $subquery = "(a.start between DATE_FORMAT(NOW() ,'%Y-01-01') AND NOW())";
        else if( $request->request->get("type") == "d" )
            $subquery = "(a.start between DATE_FORMAT(NOW() ,'%Y-%m-%d 00:00:00') AND NOW())";
                
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
        'SELECT SUM(TIMESTAMPDIFF(SECOND,a.\'start\',a.\'end\')) as diff, a '
                . 'FROM JngActivityBundle:ActivityStorage a '
                . 'JOIN a.activity ac '
                . 'JOIN ac.customer c '
        . 'WHERE a.user = :user and '.$subquery.' group by c.id'
                )->setParameter('user', $user);
        $ee = $query->getResult();
        
        return $this->render('JngActivityBundle:ActivityStorage:chart.html.twig', array(
                    'ee' => $ee
        ));
        
    }

    /**
     * Creates a new ActivityStorage entity.
     *
     */
    public function createAction(Request $request) {

        $entity = new ActivityStorage();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        //$request->request->get('jng_activitybundle_activitystorage');
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if ($form->get('start')->isEmpty()) {
                //$entity->setStartValue();
                $entity->setStart(new \DateTime());
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('activitystorage', array('id' => $entity->getId())));
        }

        return $this->render('JngActivityBundle:ActivityStorage:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ActivityStorage entity.
     *
     * @param ActivityStorage $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ActivityStorage $entity) {
        $entity->setUser($this->getUser());

        $form = $this->createForm(new ActivityStorageType($this->getUser()), $entity, array(
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
    public function newAction() {
        $entity = new ActivityStorage();
        $form = $this->createCreateForm($entity);
        $form->remove("start");
        $form->remove("end");
        return $this->render('JngActivityBundle:ActivityStorage:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new ActivityStorage entity.
     *
     */
    public function newmanuallyAction() {
        $entity = new ActivityStorage();
        $form = $this->createCreateForm($entity);

        return $this->render('JngActivityBundle:ActivityStorage:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ActivityStorage entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JngActivityBundle:ActivityStorage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActivityStorage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JngActivityBundle:ActivityStorage:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing ActivityStorage entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JngActivityBundle:ActivityStorage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActivityStorage entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JngActivityBundle:ActivityStorage:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
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
    private function createEditForm(ActivityStorage $entity) {
        $form = $this->createForm(new ActivityStorageType($this->getUser()), $entity, array(
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
    public function updateAction(Request $request, $id) {
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

            return $this->redirect($this->generateUrl('activitystorage', array('id' => $id)));
        }

        return $this->render('JngActivityBundle:ActivityStorage:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ActivityStorage entity.
     *
     */
    public function deleteAction(Request $request, $id) {
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
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('activitystorage_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

    /**
     * stop the activity
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param type $id
     * @return type
     * @throws type
     */
    public function stopAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JngActivityBundle:ActivityStorage')->find($id);

        $activity = $entity->getActivity();
        $task = $entity->getTask();
        $start = $entity->getStart();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActivityStorage entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->setActivity($activity);
            $entity->setTask($task);
            $entity->setStart($start);
            $entity->setEndValue();
            $em->persist($entity);
            $em->flush();


            return $this->redirect($this->generateUrl('activitystorage', array('id' => $id)));
        }
    }
    
    /**
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return type
     */
    public function exportexcelAction(Request $request, $date1, $date2){
        
        $user = $this->container->get('security.context')->getToken()->getUser();

        if( $user == "anon." ){
            echo "No access for anonymous !";
            exit(0);
        }
        
        $xlsTmpPath = dirname(__FILE__)."/../Resources/public/tmp/template.xls";
        $xlsTmpPathOut = $this->get('kernel')->getRootDir()."/../web/tmp/".$date1."_out.xls";
        
        // we load the template xls file
        $phpexcel = $this->get('phpexcel');
        $objPHPExcel = $this->get('phpexcel')->createPHPExcelObject($xlsTmpPath);
        
        // xls info file @TODO modify it with conf de file
        $objPHPExcel->getProperties()->setCreator("Julnegre")
                            ->setLastModifiedBy("Julnegre")
                            ->setTitle("Activities from $date1 to $date2")
                            ->setSubject("Activities from $date1 to $date2")
                            ->setDescription("Activities from $date1 to $date2");

        $objPHPExcel->setActiveSheetIndex(0);

        $activeSheet = $objPHPExcel->getActiveSheet();

        // select data 

      $em = $this->getDoctrine()->getManager();
      
      $query = $em->createQuery(
        'SELECT j as token FROM JngActivityBundle:ActivityStorage j '
              . 'WHERE j.user=:user and j.start BETWEEN :d1 AND :d2'
      )->setParameter('d1', $date1)
            ->setParameter('d2', $date2." 23:59:59")
            ->setParameter('user', $user);
      $entities = $query->getResult(Query::HYDRATE_OBJECT);

        $data = array();
        
        // init data
        foreach( range(0,30) as $r ){
            $data[] = array("","","");
        }
        
        // @TODO add customer
        $customer = "AGCONSEIL";
        
        foreach($entities as $ent ){
            $act = $ent["token"];
            
            if( $act->getActivity()->getCustomer()->getName() != $customer )
                continue;
            
            $day = date("j",$act->getStart()->getTimestamp());

            if( isset($data[$day-1]) )
                $activity = $data[$day-1][0];
            else 
                $activity="";
            $activity .= "- ".$ent["token"]->getActivity()->getName()."\n";

            //$t = ($act->getEnd()->getTimestamp()) - ($act->getStart()->getTimestamp());
            //$temps = $t/3600;
            $temps = "3.5";//@TODO à modifier -  
            
            $data[$day-1] = array($activity,"","",$temps);
            
        }
        
        $activeSheet->fromArray($data, null, 'C11');  

        // TODO ****************************
       
        // we write the new file in public tmp directory
        $writer = $this->get('phpexcel')->createWriter($objPHPExcel, 'Excel5');
        touch($xlsTmpPathOut);
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');

        // It will be called file.xls
        header('Content-Disposition: attachment; filename="act_'.$date1.'_'.$date2.'.xls"');
        $writer->save('php://output');

        exit(0);

    }
}
