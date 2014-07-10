<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Emp_schedule
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="Emp_schedule")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $event;
    /**
     * @ORM\ManyToOne(targetEntity="Emp_schedule")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     */
    private $employee;
    /**
    * @ORM\Column(type="time")
    */
    protected $emp_start_time;
}
