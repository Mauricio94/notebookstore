<?php

/**
 * @package local
 * @subpackage notebookstore
 * @copyright 2015 Mauricio Meza (mameza@alumnos.uai.cl)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(dirname(__FILE__))))."/config.php");
require_once ($CFG->libdir . "/formslib.php");
 
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

class notebook_form extends moodleform {

public function definition() {
        global $CFG;
        $mform = $this->_form;
 
        $mform->addElement("text", "id", get_string("notebooksid", "local_notebookstore"));
        $mform->setType("id", PARAM_INT);
        $mform->addRule("id", get_string("required", "local_notebookstore") ,"required",  null, "notebook");
    
        $mform->addElement("text", "company", get_string("notebookscompany", "local_notebookstore"));
        $mform->setType("company", PARAM_TEXT);
        $mform->addRule("company", get_string("required", "local_notebookstore") ,"required",  null, "notebook");
        
        $mform->addElement("text", "cpu", get_string("notebookscpu", "local_notebookstore"));
        $mform->setType("cpu", PARAM_TEXT);
        $mform->addRule("cpu", get_string("required", "local_notebookstore") ,"required",  null, "notebook");
        
        $mform->addElement("text", "ram", get_string("notebooksram", "local_notebookstore"));
        $mform->setType("ram", PARAM_TEXT);
        $mform->addRule("ram", get_string("required", "local_notebookstore") ,"required",  null, "notebook");
        
        $mform->addElement("text", "memory", get_string("notebooksmemory", "local_notebookstore"));
        $mform->setType("memory", PARAM_TEXT);
        $mform->addRule("memory", get_string("required", "local_notebookstore") ,"required",  null, "notebook");
        
        $mform->addElement("text", "price", get_string("notebooksprice", "local_notebookstore"));
        $mform->setType("price", PARAM_TEXT);
        $mform->addRule("price", get_string("required", "local_notebookstore") ,"required",  null, "notebook");
        
        $this->add_action_buttons(true);
    }
    
    function validation($data, $files){
    	global $DB;
    	 
    	$errors = array();
    	$id=$data["id"];
    	$company=$data["company"];
    	$cpu=$data["cpu"];
    	$ram=$data["ram"];
    	$memory=$data["memory"];
    	$price=$data["price"];
    	
    	if($id=null){
    		$errors["id"] = get_string("emptyfield", "local_notebookstore");
    	}
    	elseif($company=null){
    		$errors["company"] = get_string("emptyfield", "local_notebookstore");
    	}
    	elseif($cpu=null){
    		$errors["cpu"] = get_string("emptyfield", "local_notebookstore");
    	}
    	elseif($ram=null){
    		$errors["ram"] = get_string("emptyfield", "local_notebookstore");
    	}
    	elseif($memory=null){
    		$errors["memory"] = get_string("emptyfield", "local_notebookstore");
    	}
    	elseif($company=null){
    		$errors["price"] = get_string("emptyfield", "local_notebookstore");
    	}
    }
}

class addnotebook_form extends moodleform {

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
		if($rut=null){
			$errors['herramienta'] = 'Tiene que llenar el campo';
		}
		elseif($name=null){
			$errors['codigo'] = 'Tiene que llenar el campo';
		}
		elseif($lastname=null){
			$errors['stock'] = 'Tiene que llenar el campo';
		}
	}
}