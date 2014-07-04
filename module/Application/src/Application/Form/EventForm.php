<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;

$date = new Element\Date('date');
	

class EventForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('event');
        $this->setAttribute('method', 'post');
		

        $this->add(array(
            'type' => 'Zend\Form\Element\Date',
            'name' => 'date',
            'options' => array(
                'label' => 'Datum događaja'
            ),
            'attributes' => array(
                'class' => 'my_input',
                'step' => '1', 
            )
        ));  

        $this->add(array(
            'name' => 'location',
            'attributes' => array(
                'type'  => 'text',
				'class' => 'my_input',
            ),
            'options' => array(
                'label' => 'Lokacija',
            ),
        ));
	
        $this->add(array(
            'name' => 'remark',
            'attributes' => array(
                'type'  => 'textarea',
                        'class' => 'my_input',
                        'rows' => '5',
                        'cols' => '30',
            ),
            'options' => array(
                'label' => 'Napomena',
            ),
        ));
		
        $this->add(array(
            'name' => 'redaction',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'my_input',
            ),
            'options' => array(
                'label' => 'Redakcija',
            ),
        ));
		
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
				'class' => 'my_input',
            ),
            'options' => array(
                'label' => 'Ime događaja',
            ),
        ));
		
        $this->add(array(
                 'type' => 'Zend\Form\Element\Time',
                 'name' => 'time',
                 'options' => array(
                                 'label' => 'Vreme događaja'
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
