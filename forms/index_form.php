<?php

/**
 * @package local
 * @subpackage notebookstore
 * @copyright 2015 Mauricio Meza (mameza@alumnos.uai.cl)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

//Mientras no este seguro de que agrego algo con esta pagina, la mantendre sin hacer nada
/**require_once(dirname(__FILE__) . '/../../config.php');
require_once($CFG->libdir.'/formslib.php');

class index_form extends moodleform {
	//Add elements to form
	public function definition() {
		global $CFG;

		$mform = $this->_form; // Don't forget the underscore!

		$mform->addElement('text', 'email', get_string('email')); // Add elements to your form
		$mform->setType('email', PARAM_NOTAGS);                   //Set type of element
		$mform->setDefault('email', 'Please enter email');        //Default value
	
	}
	//Custom validation should be added here
	function validation($data, $files) {
		return array();
	}
}