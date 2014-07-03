<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Event
{
    // ...

    /**
     * @ORM\ManyToMany(targetEntity="Employee")
     * @ORM\JoinTable(name="events_employees",
     *      joinColumns={@ORM\JoinColumn(name="event_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="employee_id", referencedColumnName="id")}
     *      )
     **/
    
    private $events;
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
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
}