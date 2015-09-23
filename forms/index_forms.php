<?php

/**
 * @package local
 * @subpackage notebookstore
 * @copyright 2015 Mauricio Meza (mameza@alumnos.uai.cl)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(dirname(__FILE__))))."/config.php");
require_once ($CFG->libdir . "/formslib.php");
 
class addclient_form extends moodleform {

    public function definition() {
        global $CFG;
        $mform = $this->_form;
 
        $mform->addElement("text", "rut", get_string("clientsrut", "local_notebookstore"));
        $mform->setType("rut", PARAM_INT);
        $mform->addRule("rut", get_string("required", "local_notebookstore") ,"required",  null, "client");
    
        $mform->addElement("text", "name", get_string("clientsname", "local_notebookstore"));
        $mform->setType("name", PARAM_TEXT);
        $mform->addRule("name", get_string("required", "local_notebookstore") ,"required",  null, "client");
        
        $mform->addElement("text", "lastname", get_string("clientslastname", "local_notebookstore"));
        $mform->setType("lastname", PARAM_TEXT);
        $mform->addRule("lastname", get_string("required", "local_notebookstore") ,"required",  null, "client");
    
        $mform->addElement ("hidden", "action", "add");
        $mform->setType ("action", PARAM_TEXT);
        
        $this->add_action_buttons(true);
    }
    
    function validation($data, $files){
    	global $DB;
    	 
    	$errors = array();
    	$rut=$data["rut"];
    	$name=$data["name"];
    	$lastname=$data["lastname"];
    	
    	if($rut=null){
    		$errors["rut"] = get_string("emptyfield", "local_notebookstore");
    	}
    	elseif($name=null){
    		$errors["name"] = get_string("emptyfield", "local_notebookstore");
    	}
    	elseif($lastname=null){
    		$errors["lastname"] = get_string("emptyfield", "local_notebookstore");
    	}
    }
}

class editclient_form extends moodleform {

	public function definition() {
		global $CFG;
		$mform = $this->_form;
		$instance = $this->_customdata;
		
		$rutclient = $instance["rutclient"];

		$mform->addElement("text", "rut", get_string("clientsrut", "local_notebookstore"));
		$mform->setType("rut", PARAM_INT);
		$mform->addRule("rut", get_string("required", "local_notebookstore") ,"required",  null, "client");

		$mform->addElement("text", "name", get_string("clientsname", "local_notebookstore"));
		$mform->setType("name", PARAM_TEXT);
		$mform->addRule("name", get_string("required", "local_notebookstore") ,"required",  null, "client");

		$mform->addElement("text", "lastname", get_string("clientslastname", "local_notebookstore"));
		$mform->setType("lastname", PARAM_TEXT);
		$mform->addRule("lastname", get_string("required", "local_notebookstore") ,"required",  null, "client");

		$mform->addElement ("hidden", "action", "edit");
        $mform->setType ("action", PARAM_TEXT);
        $mform->addElement("hidden", "rutclient", $rutclient);
        $mform->setType("rutclient", PARAM_INT);

		$this->add_action_buttons(true);
	}

	function validation($data, $files){
		global $DB;

		$errors = array();
		$rut=$data["rut"];
		$name=$data["name"];
		$lastname=$data["lastname"];
		 
		if($rut=null){
			$errors["rut"] = get_string("emptyfield", "local_notebookstore");
		}
		elseif($name=null){
			$errors["name"] = get_string("emptyfield", "local_notebookstore");
		}
		elseif($lastname=null){
			$errors["lastname"] = get_string("emptyfield", "local_notebookstore");
		}
	}
}