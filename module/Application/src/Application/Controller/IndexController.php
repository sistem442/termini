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

class IndexController extends AbstractActionController
{
    protected $_objectManager;
    public function indexAction()
    {
         $events = $this->getObjectManager()->getRepository('\Application\Entity\Event')->findAll();

        return new ViewModel(array('events' => $events));
    }
        public function addAction()
    {
        if ($this->request->isPost()) {
            $event = new Event();
            $event->setName_of_event($this->getRequest()->getPost('name_of_event'));
            $this->getObjectManager()->persist($event);
            $this->getObjectManager()->flush();
            echo 'new id: '.$event->getId();
            die;
            return $this->redirect()->toRoute('home');
        }
        echo'aaa';
        return new ViewModel();
    }
    protected function getObjectManager()
    {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }


}
