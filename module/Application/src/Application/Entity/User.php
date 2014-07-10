<?php
namespace HelloWorld;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
 
use InvalidArgumentException;
 
/**
* This class is somewhere in your library
* @ORM\Entity
* @ORM\Table(name="users")
*/
class User {
 
    /**
     * @ORM\var int
     * @ORM\Id
     * @ORM\Column(type="integer",name="id", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
     
     /**
     * @ORM\var string
     * @ORM\Column(type="string", length=255, name="login", nullable=false)
     */
    protected $login;
    
     /**
     * @ORM\var UserGroup|null the group this user belongs (if any)
     * @ORM\ManyToOne(targetEntity="HelloWorld\UserGroup", inversedBy="users")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     */
    protected $group;
    
    /**
     * @ORM\param string $login
     */
    public function __construct($login) {
        $this->setLogin($login);
    }
    
    /**
     * @ORM\return string
     */
    public function getLogin() {
        return $this->login;
    }
    
    /**
     * @ORM\param string $login
     */
    public function setLogin($login) {
        $this->login = (string) $login;
    }
    
    /**
     * @ORM\return HelloWorld\UserGroup|null
     */
    public function getGroup() {
        return $this->group;
    }
    
    /**
     * Sets a new user group and cleans the previous one if set
     * @ORM\param null|HelloWorld\UserGroup $group
     */
    public function setGroup($group) {
        if($group === null) {
            if($this->group !== null) {
                $this->group->getUsers()->removeElement($this);
            }
            $this->group = null;
        } else {
            if(!$group instanceof HelloWorld\UserGroup) {
                throw new InvalidArgumentException('$group must be null or instance of HelloWorld\UserGroup');
            }
            if($this->group !== null) {
                $this->group->getUsers()->removeElement($this);
            }
            $this->group = $group;
            $group->getUsers()->add($this);
        }
    }
    
}
