<?php

namespace Ibrows\TaskBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;

class TaskController extends Controller {

    /**
     * @Route("/", name="task_create")
     * @Template()
     */
    public function createAction() {
        $em = $this->getDoctrine()->getEntityManager();
        
        $task = new \Ibrows\TaskBundle\Entity\Task();
        
        $form = $this->createForm(new \Ibrows\TaskBundle\Form\TaskType(), $task);
        
        if($this->getRequest()->getMethod()=='POST') {
            $form->bindRequest($this->getRequest());
            if($form->isValid()) {
                $em->persist($task);
                foreach($task->getTags() as $tag) {
                    $em->persist($tag);
                }

                $em->flush();
            }
        }
        
        return array('form' => $form->createView());
    }
    
    /**
     * @Route("/edit/{id}", name="task_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $task = $em->getRepository('IbrowsTaskBundle:Task')->find($id);
        
        $form = $this->createForm(new \Ibrows\TaskBundle\Form\TaskType(), $task);
        
        if($this->getRequest()->getMethod()=='POST') {
            var_dump(count($task->getTags()));
            $form->bindRequest($this->getRequest());
            var_dump(count($task->getTags()));
            if($form->isValid()) {
                $em->persist($task);
                foreach($task->getTags() as $tag) {
                    $em->persist($tag);
                }
                
                $em->flush();
                
//                return $this->redirect($this->generateUrl('task_create'));
            }
        }
        
        return array('form' => $form->createView(), 'id' => $id);
    }
}
