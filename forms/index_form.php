<?php

/**
 * @package local
 * @subpackage notebookstore
 * @copyright 2015 Mauricio Meza (mameza@alumnos.uai.cl)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**Mientras no este seguro de que agrego algo con esta pagina, la mantendre sin hacer nada
require_once(dirname(__FILE__) . '/../../config.php');
require_once("$CFG->libdir/formslib.php");
 
class clients_form extends moodleform {

    public function definition() {
        global $CFG;
        $mform = $this->_form;
 
        $mform->addElement("text", "rut", get_string("clientsrut", "local_notebooks"));
        $mform->setType("rut", PARAM_INT);
        $mform->addRule("rut", get_string("required", "local_notebookstore") ,"required",  null, "client");
    
        $mform->addElement("text", "name", get_string("clientsname", "local_notebooks"));
        $mform->setType("name", PARAM_TEXT);
        $mform->addRule("name", get_string("required", "local_notebookstore") ,"required",  null, "client");
        
        $mform->addElement("text", "lastname", get_string("clientslastname", "local_notebooks"));
        $mform->setType("lastname", PARAM_TEXT);
        $mform->addRule("lastname", get_string("required", "local_notebookstore") ,"required",  null, "client");
    }
    
    function validation($data, $files){
    	global $DB;
    	 
    	$errors = array();
    	$rut=$data["rut"];
    	$name=$data["name"];
    	$lastname=$data["lastname"];
    	if($herramienta=null){
    		$errors['herramienta'] = 'Tiene que llenar el campo';
    	}
    	elseif($codigo=null){
    		$errors['codigo'] = 'Tiene que llenar el campo';
    	}
    	elseif($sotck=null){
    		$errors['stock'] = 'Tiene que llenar el campo';
    	}
    	elseif($categoria=null){
    		$errors['categoria'] = 'Tiene que llenar el campo';
    	}
    	return $errors;
    }
}