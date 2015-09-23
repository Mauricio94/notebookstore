<?php

/**
 * @package local
 * @subpackage notebookstore
 * @copyright 2015 Mauricio Meza (mameza@alumnos.uai.cl)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(dirname(__FILE__))))."/config.php");
require_once ($CFG->libdir . "/formslib.php");

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