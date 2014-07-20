<?php
/**
 * Test Ajax Module
 *
 * @link      http://github.com/samsonasik/TestAjax for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Samsonasik (http://samsonasik.wordpress.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace TestAjax\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;
use TestAjax\Entity\TestEntity;

// Doctrine Entity manager
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// We may prepare the Doctrine Class Loader if we didn't have Composer Autoloader and Zend Standard Autoloader
use Doctrine\Common\ClassLoader;

// Doctrine Annotations
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder as DoctrineAnnotationBuilder;


class SkeletonController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }
    
    //build the form using anotations
    protected function getForm()
    {
        $builder    = new AnnotationBuilder();
        $entity     = new TestEntity();
        $form       = $builder->createForm($entity);
        
        return $form;
    }
    //Use doctrine to save to DB
    public function savetodb($data)
    {
    	if ($this->request->isPost()) {
    
    		$test = new TestEntity();
    		$test->setName($this->getRequest()->getPost('name'));
    		 
    		$this->getObjectManager()->persist($test);
    		$this->getObjectManager()->flush();
    		return $this->redirect()->toRoute('home');
    	}
    }
    
    public function showformAction()
    {
        $viewmodel = new ViewModel();
        $form       = $this->getForm();

        $request = $this->getRequest();
        
        //disable layout if request by Ajax
        $viewmodel->setTerminal($request->isXmlHttpRequest());
        
        $is_xmlhttprequest = 1;
        if ( ! $request->isXmlHttpRequest()){
            //if NOT using Ajax
            $is_xmlhttprequest = 0;
            if ($request->isPost()){
                $form->setData($request->getPost());
                if ($form->isValid()){
                    //save to db ;)
                    $this->savetodb($form->getData());
                }
            }
        }
        
        $viewmodel->setVariables(array(
                    'form' => $form,
                    'is_xmlhttprequest' => $is_xmlhttprequest //need for check this form is in modal dialog or not in view
        ));
        
        return $viewmodel;
    }
    
    
    
    public function validatepostajaxAction()
    {
        $form    = $this->getForm();
        $request = $this->getRequest();
        $response = $this->getResponse();
        
        $messages = array();
        if ($request->isPost()){
            $form->setData($request->getPost());
            if ( ! $form->isValid()) {
                $errors = $form->getMessages();
                foreach($errors as $key=>$row)
                {
                    if (!empty($row) && $key != 'submit') {
                        foreach($row as $keyer => $rower)
                        {
                            $messages[$key][] = $rower;    
                        }
                    }
                }
            }
            
            if (!empty($messages)){        
                $response->setContent(\Zend\Json\Json::encode($messages));
            } else {
                //save to db ;)
                $this->savetodb($form->getData());
                $response->setContent(\Zend\Json\Json::encode(array('success'=>1)));
            }
        }
        
        return $response;
    }
    protected function getObjectManager()
    {
    	if (!$this->_objectManager) {
    		$this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	}
    
    	return $this->_objectManager;
    }
}