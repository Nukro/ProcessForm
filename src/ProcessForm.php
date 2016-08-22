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
 * Then you can create a new ProcessForm() object and start building your form with the addInput() Function.
 * 
 * Enjoy and start building you Forms with ease!
 *
 */

class ProcessForm{

	public $formObject;



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
		$this->formObject = $form;
	}


/**
	 * Adds Input to your form object
	 * @param array  $opts     [description]
	 * @param [type] $fieldset [description]
	 */
	function addInput($opts = array(), $fieldset){
		$attributes = $opts['attributes'];
		$options = $opts['options'];

		$field = wire('modules')->get($opts['type']);
		$field->label = $opts['label'];


		if (array_filter($attributes)) {
			foreach ($attributes as $key => $value) {
				$field->attr($key, $value);
			}
		}
	
		if (array_filter($options)) {
			foreach ($options as $key => $value) {
			    $field->addOption($key, $value);
			}
		}

		if($opts['collapsed'] == TRUE){
			$field->collapsed = Inputfield::collapsedYes;
		}

		if($opts['showIf'] != ""){
			$field->showIf = $opts['showIf'];
		}

		if($opts['columnWidth'] != ""){
			$field->columnWidth = $opts['columnWidth'];
		}

		if($opts['value'] != ""){
			$field->value = $opts['value'];
		}

		if($opts['required'] != ""){
			$field->required = $opts['required'];
		}else{
			$field->required = 0;
		}

		if($fieldset == ""){
			$this->formObject->add($field);
		}else{
			$fieldset->add($field);
		}

		if($opts['type'] == "InputfieldFieldset"){
			return $field;
		}	
	}

	/**
	 * render the formobject
	 * @return [type] [description]
	 */
	function render(){
		return $this->formObject->render();
	}

}



?>
