<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Event
{
     /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
    /**
    * @ORM\Column(type="string")
    */
    protected $name;
    /**
    * @ORM\Column(type="date")
    */
    protected $date;
    /**
    * @ORM\Column(type="string")
    * @ORM\Column(length=50)
    */
    protected $location;
    /**
    * @ORM\Column(type="time")
    */
    protected $time;
    /**
    * @ORM\Column(type="string")
    * @ORM\Column(length=500)
    */
    protected $remark;
    /**
    * @ORM\Column(type="string")
    * @ORM\Column(length=30)
    */
    protected $redaction;
    
    
    
    public function setName($value)
        {
            $this->name = $value;
        }
	public function setDate($value)
        {
            $this->date = $value;
        }
	public function setLocation($value)
        {
            $this->location = $value;
        }
	public function setTime($value)
        {
            $this->time = $value;
        }
	public function setRemark($value)
        {
            $this->remark = $value;
        }
	public function setRedaction($value)
        {
            $this->redaction = $value;
        }
    public function getId()
    {
        return $this->id;
    }
    public function getName_of_event()
    {
        return $this->name;
    }
    // ...

    public function __construct() {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }
}

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
}

/** @ORM\Entity */
class Work_schedule
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="Work_schedule")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $event;
    /**
     * @ORM\ManyToOne(targetEntity="Work_schedule")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     */
    private $employee;
    /**
    * @ORM\Column(type="time")
    */
    protected $emp_start_time;
}
