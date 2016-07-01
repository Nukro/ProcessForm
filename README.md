# ProcessForm
A Simple wrapper class for the Form API of the Processwire CMS

This is a simple Wrapper Class to minimze the code when using the Form API of the Processwire CMS...

###The old fashioned way to build a Form with the Form API of the Processwire CMS:
```php
$form = $modules->get("InputfieldForm");
$form->action = "./somewhere";
$form->method = "post";
$form->attr("id+name", "NormalForm");

$field = $modules->get("InputfieldText");
$field->label = "First Name";
$field->attr("id+name", "firstname");
$field->required = 1;
$form->append($field);

$field = $modules->get("InputfieldText");
$field->label = "Surname";
$field->attr("id+name", "surname");
$field->required = 1;
$form->append($field);

$field = $modules->get("InputfieldRadio");
$field->label = "To much code for a simple Form?";
$field->attr("id+name", tomuchcode);
$field->addOption("yes", "Yes, absolutely");
$field->addOption("no", "No, absolutely not");
$field->required = 1;
$form->append($field);

$form->render();
```
###The simple ProcessForm Way:
```php

$form = new ProcessForm("./contact", "post", "contactform"); //default ("./", "post", "ProcessForm")

$form->addInput(array(
	'type' => "InputfieldText", 
	'label' => "First Name",
	'attributes' => array('id' => "firstname", 'name' => "firstname"),
	'required' => 1
));

$form->addInput(array(
	'type' => "InputfieldText", 
	'label' => "Surname",
	'attributes' => array('id' => "surname", 'name' => "surname"),
	'required' => 1
));

$form->addInput(array(
	'type' => "InputfieldRadios", 
	'label' => "To much code for a simple Form?",
	'value' => "herr",
	'options' => array('yes' => "Yes, absolutely", 'no' => "No, absolutely not"),
	'attributes' => array('id' => "tomuchcode", 'name' => "tomuchcode"),
	'required' => 1
));


$form->render();
```
@author Orkun Atasoy aka "Nukro"
