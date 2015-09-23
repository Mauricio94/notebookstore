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


class addnotebook_form extends moodleform {

public function definition() {
        global $CFG;
        $mform = $this->_form;
    
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
        
        $mform->addElement ("hidden", "action", "add");
        $mform->setType ("action", PARAM_TEXT);
        
        $this->add_action_buttons(true);
    }
    
    function validation($data, $files){
    	global $DB;
    	 
    	$errors = array();
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

class editnotebook_form extends moodleform {

public function definition() {
        global $CFG;
        $mform = $this->_form;
        $instance = $this->_customdata;
        
        $idnotebook = $instance["idnotebook"];
    
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
        
        $mform->addElement ("hidden", "action", "edit");
        $mform->setType ("action", PARAM_TEXT);
        $mform->addElement("hidden", "idnotebook", $idnotebook);
        $mform->setType("idnotebook", PARAM_INT);
        
        $this->add_action_buttons(true);
    }
    
    function validation($data, $files){
    	global $DB;
    	 
    	$errors = array();
    	$id = $data["id"];
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

class addreceipt_form extends moodleform{
	function definition(){
		global $DB;
		$mform = $this->_form;

		$clients = $DB->get_records("clients");
		$dataclients = array();
		foreach( $clients as $client ){
			$dataclients[$client->rut] = $client->name." ".$client->lastname;
		}
		$selectclients = $mform->addElement("select", "clientsrut", get_string("selectclients","local_notebookstore"),$dataclients);
				
		$notebooks = $DB->get_records("notebooks");
		$datanotebooks = array();
		foreach( $notebooks as $notebook ){
			$datanotebooks[$notebook->id] = $notebook->company." ".
			$notebook->cpu." ".
			get_string("notebooksram", "local_notebookstore")." ".
			$notebook->ram." ".
			get_string("gb", "local_notebookstore")." ".
			get_string("notebooksmemory", "local_notebookstore")." ".
			$notebook->memory."".
			get_string("gb", "local_notebookstore");
			}
		$selectnotebooks = $mform->addElement("select", "notebooksid", get_string("selectnotebooks","local_notebookstore"),$datanotebooks);
		
		$mform->addElement("hidden", "action", "add");
		$mform->setType("action", PARAM_TEXT);
			
		$this->add_action_buttons(true);
	}
	function validation($data, $files){
		global $DB;
		$errors = array();

		return $errors;
	}
}
