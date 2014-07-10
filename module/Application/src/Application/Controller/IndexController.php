<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Event;
use Application\Entity\Employee;

use Application\Form\EventFilter;
use Application\Form\EventForm;
use Application\Form\EmployeeForm;

// Doctrine Entity manager
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// We may prepare the Doctrine Class Loader if we didn't have Composer Autoloader and Zend Standard Autoloader
use Doctrine\Common\ClassLoader;

// Doctrine Annotations
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder as DoctrineAnnotationBuilder;

// for the form
use Zend\Form\Element;

class IndexController extends AbstractActionController
{
    protected $_objectManager;
    public function indexAction()
    {
    $current_month = '2014-06-01';//date('Y-m').'-01'; 
        
    $events = $this->getObjectManager()
    ->createQuery('SELECT e FROM \Application\Entity\Event e WHERE e.date >= '.$current_month.'ORDER BY e.redaction')
    ->getResult();
    
        return new ViewModel(array('events' => $events));
    }
    
	public function addEventAction()
    {
        if ($this->request->isPost()) {

			$event = new Event();
			$date = new \DateTime($this->getRequest()->getPost('date'));
			$event->setDate($date);
			$event->setLocation($this->getRequest()->getPost('location'));
			$time = new \DateTime($this->getRequest()->getPost('time'));
			$event->setTime($time);
			$event->setRemark($this->getRequest()->getPost('remark'));
			$event->setRedaction($this->getRequest()->getPost('redaction'));							
     
			$this->getObjectManager()->persist($event);
			$this->getObjectManager()->flush();
            return $this->redirect()->toRoute('home');
        }
        $form = new EventForm();
		return new ViewModel(array('form' => $form));
    }
    
    public function editEventAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $event = $this->getObjectManager()->find('\Application\Entity\Event', $id);
        
        if ($this->request->isPost()) {
            $event->setName($this->getRequest()->getPost('name'));
            $date = new \DateTime($this->getRequest()->getPost('date'));
            $event->setDate($date);
            $event->setLocation($this->getRequest()->getPost('location'));
            $time = new \DateTime($this->getRequest()->getPost('time'));
            $event->setTime($time);
            $event->setRemark($this->getRequest()->getPost('remark'));
            $event->setRedaction($this->getRequest()->getPost('redaction'));
      
            $this->getObjectManager()->persist($event);
            $this->getObjectManager()->flush();
            return $this->redirect()->toRoute('home');
        }
        $form = new EventForm();
        return new ViewModel(array('event' => $event));
    }
    
    public function GetAddEmployeeAction()
    {
        if ($this->request->isPost()) {
        
            $employee = new Employee();
            $employee->setName($this->getRequest()->getPost('name'));

            echo 'name: '.$this->getRequest()->getPost('name').'</br>';
            
            $this->getObjectManager()->persist($employee);
            $this->getObjectManager()->flush();
            return $this->redirect()->toRoute('application/default', array('controller' => 'Index', 'action' => 'GetAddEmployee'));
        }
        $employees = $this->getObjectManager()->getRepository('\Application\Entity\Employee')->findAll();
        $form = new EmployeeForm();
        return new ViewModel(array('form' => $form,'employees' => $employees));
    }
    
    public function EditEmployeeAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $employee = $this->getObjectManager()->find('\Application\Entity\Employee', $id);

        if ($this->request->isPost()) {
            $employee->setName($this->getRequest()->getPost('name'));

            $this->getObjectManager()->persist($employee);//employee is now managed
            $this->getObjectManager()->flush();// commit changes to db

            return $this->redirect()->toRoute('application/default', array('controller' => 'Index', 'action' => 'GetAddEmployee'));
        }

        return new ViewModel(array('employee' => $employee));		
	}
	
	public function DeleteEmployeeAction()
	{
	    $id = (int) $this->params()->fromRoute('id', 0);
	    $employee = $this->getObjectManager()->find('\Application\Entity\Employee', $id);
	
	    if ($this->request->isPost()) {
	        $this->getObjectManager()->remove($employee);
	        $this->getObjectManager()->flush();
	
	        return $this->redirect()->toRoute('application/default', array('controller' => 'Index', 'action' => 'GetAddEmployee'));
	    }
	
	    return new ViewModel(array('employee' => $employee));
	}
	
    
    protected function getObjectManager()
    {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }
}