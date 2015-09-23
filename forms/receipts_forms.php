<?php

/**
 * @package local
 * @subpackage notebookstore
 * @copyright 2015 Mauricio Meza (mameza@alumnos.uai.cl)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
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

class editreceipt_form extends moodleform{
	function definition(){
		global $DB;
		$mform = $this->_form;
		$instance = $this->_customdata;

		$idreceipt = $instance["idreceipt"];
		$receipt = $DB->get_record("receipts", array("id"=>$idreceipt));

		$clients = $DB->get_records("clients");
		$dataclients = array();
		foreach( $clients as $client ){
			$dataclients[$client->rut] = $client->name." ".$client->lastname;
		}
		$selectclients = $mform->addElement("select", "clientsrut", get_string("selectclients","local_notebookstore"),$dataclients);
		$selectclients->setSelected($client->rut = $receipt->clientsrut);

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
		$selectnotebooks->setSelected($notebook->id = $receipt->notebooksid);

		$mform->addElement("hidden", "action", "edit");
		$mform->setType("action", PARAM_TEXT);
		$mform->addElement("hidden", "idreceipt", $idreceipt);
		$mform->setType("idreceipt", PARAM_INT);
			
		$this->add_action_buttons(true);
	}
	function validation($data, $files){
		global $DB;
		$errors = array();

		return $errors;
	}
}
