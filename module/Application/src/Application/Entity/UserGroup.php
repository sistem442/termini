<?php
namespace HelloWorld;
 
use Doctrine\Common\Collections\Collection,
    Doctrine\Common\Collections\ArrayCollection,
	Doctrine\ORM\Mapping as ORM;
    
/**
* This class is somewhere in your library
* @ORM\Entity
* @ORM\Table(name="usergroups")
*/
class UserGroup {
 
    /**
     * @ORM\var int
     * @ORM\Id
     * @ORM\Column(type="integer",name="id", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
     
     /**
     * @ORM\var string
     * @ORM\Column(type="string", length=255, name="name", nullable=false)
     */
    protected $name;
    
     /**
     * @ORM\var Collection
     * @ORM\OneToMany(targetEntity="HelloWorld\User", mappedBy="group")
     */
    protected $users;
    
    /**
     * @ORM\param string $name
     */
    public function __construct($name) {
        $this->users = new ArrayCollection();
        $this->setName($name);
    }
    
    /**
     * @ORM\return string
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * @ORM\var string $name 
     */
    public function setName($name) {
        $this->name = (string) $name;
    }
    
    /**
     * @ORM\return Collection
     */
    public function getUsers() {
        return $this->users;
    }
    
}
