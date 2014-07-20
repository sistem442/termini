<?php

namespace TestAjax\Entity;

use Zend\Form\Annotation;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity 
	@ORM\Table(name="testajax")
	*/

class TestEntity
{
	/**
     * @ORM\Id
     * @ORM\Column(type="integer",name="id", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
    /**
     * @ORM\Column(type="string")
     * @ORM\Column(length=30)
     * 
     */
     
    private $name;
    /**
     * @Annotation\Type("Zend\Form\Element\Submit")
     * @Annotation\Attributes({"value":"Submit"})
     * @Annotation\Attributes({"class":"submit"})
     * 
     */
    
    public $submit;
    
    public function setName($value)
    {
    	$this->name = $value;
    }
    // ...
    
    
    public function getId()
    {
    	return $this->id;
    }
    public function getName()
    {
    	return $this->name;
    }
    public function __construct() {
    	$this->testajax = new \Doctrine\Common\Collections\ArrayCollection();
    }
}