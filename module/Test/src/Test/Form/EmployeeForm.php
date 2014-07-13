<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class EmployeeForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('employee');
        $this->setAttribute('method', 'post');
		
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
				'class' => 'my_input',
            ),
            'options' => array(
                'label' => 'Ime i prezime',
            ),
        ));
		
	
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',	
                'value' => 'Upiši',
                'id' => 'SubmitButtonCreateForm',
            ),
        )); 
    }
}
