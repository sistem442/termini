<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Employee
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
    /**
    * @ORM\Column(type="string")
    * @ORM\Column(length=30)
    */
    protected $name;

public function setName($value)
        {
            $this->name = $value;
        }
	// ...

    public function __construct() {
        $this->employees = new \Doctrine\Common\Collections\ArrayCollection();
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
}


