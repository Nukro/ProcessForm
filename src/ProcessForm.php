<?php
/**
 * Wrapper Class for the Form API from Processwire
 * 
 * ProcessWire 2.x
 * Copyright (C) 2010 by Ryan Cramer
 * Licensed under GNU/GPL v2, see LICENSE.TXT
 *
 * 
 *
 * http://www.processwire.com
 * http://www.ryancramer.com
 * 
 * @author Orkun Atasoy <orkunatasoy1996@live.de>
 * 
 * Getting Started: Place the ProcessForm.php file anywhere inside your template folder and include it for example in the init.php file.
 * Then you can create a new ProcessForm() object and get the InputfieldForm Object from the InputfieldFrom Class from Processwire
 * to add Inputfields to it with the addInputfield() function. 
 * 
 * Enjoy and start building you Forms with ease!
 *
 */

class ProcessForm{

	public $inputfieldFormObject;



	/**
	 * Create a InputfieldForm Object and set it as $inputfieldFormObject Property
	 * @param string $action  Specifies where to send the form-data when a form is submitted
	 * @param string $method  Specifies the HTTP method to use when sending form-data
	 * @param string $name_id Specifies id and name attribute of the form
	 */
	function __construct($action = "./", $method = "post", $name_id = "ProcessForm"){
		$form = wire('modules')->get("InputfieldForm");
		$form->action = $action;
		$form->method = $method;
		$form->attr("id+name", $name_id);
		
		$this->inputfieldFormObject = $form;
	}


	/**
	 * Add any kind of inputfield to your Form object
	 * @param string  $inputfieldtype type of the inputfield
	 * @param object  $formobject     to which form object should it be added
	 * @param string  $label          the label of the inputfield
	 * @param array   $attributes     some input attributes like "class, id, value, name" etc..
	 * @param integer $isrequired     1 for required and 0 for non-required
	 * @param array   $options        add some options for radios, selects, checkboxes or selectmultiple inputs ($value => $title)
	 */
	function addInputfield($inputfieldtype, $formobject, $label, $attributes = array(), $isrequired = 0, $options = array()){
			$field = wire('modules')->get($inputfieldtype);
			$field->label = __($label);

			$attributes = array_filter($attributes);
			if (!empty($attributes)) {
				foreach ($attributes as $key => $value) {
					$field->attr($key, $value);
				}
			}

			$options = array_filter($options);
			if (!empty($options)) {
				foreach ($options as $key => $value) {
				    $field->addOption($key, $value);
				}
			}

			$field->required = $isrequired;
			$formobject->append($field);

			if($inputfieldtype == "InputfieldFieldset"){
				return $field;
			}
	}


	function getFormObject(){
		return $this->inputfieldFormObject;
	}

	/**
	 * render the formobject
	 * @return [type] [description]
	 */
	function render(){
		return $this->inputfieldFormObject->render();
	}

}



?>
