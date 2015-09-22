<?php

/**
 *
 * @package local
 * @subpackage notebookstore
 * @copyright 2015 Mauricio Meza (mameza@alumnos.uai.cl)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
require_once (dirname(dirname(dirname(__FILE__)))."/config.php");
require_once ($CFG->dirroot."/local/notebookstore/forms/index_form.php");
global $DB, $USER, $PAGE, $OUTPUT;

require_login();
if (isguestuser()) {
	die();
}

// Action = { view, edit, delete, create }, all page options
$action = optional_param("action", "view", PARAM_TEXT);
$rutclient = optional_param("rutclient", null, PARAM_INT);
$sesskey = optional_param("sesskey", null, PARAM_ALPHANUM);

$context = context_system::instance();

$urlindex = new moodle_url("/local/notebookstore/index.php");

// Page navigation and URL settings
$PAGE->set_url($urlindex);
$PAGE->set_context($context);
$PAGE->set_pagelayout("standard");

echo $OUTPUT->header();

if( $action == "add" ){
	$addform = new addclient_form();
	if( $addform->is_cancelled() ){
		$action = "view";
	}else if( $creationdata = $addform->get_data() ){
		$record = new stdClass();
		$record->rut = $creationdata->rut;
		$record->name = $creationdata->name;
		$record->lastname = $creationdata->lastname;
		$DB->insert_record("clients", $record);
		$action = "view";
	}
}

if( $action == "edit" ){
	if( $rutclient == null ){
		print_error(get_string("clientdoesnotexist", "local_notebookstore"));
		$action = "view";
	}else{
		if( $client = $DB->get_record("clients", array("rut"=>$rutclient)) ){
			$editform = new editclient_form(null, array(
					"rutclient" => $rutclient));
				
			$defaultdata = new stdClass();
			$defaultdata->rut = $client->rut;
			$defaultdata->name = $client->name;
			$defaultdata->lastname = $client->lastname;
			$editform->set_data($defaultdata);
				
			if( $editform->is_cancelled() ){
				$action = "view";
			}
			else if( $editform->get_data()  && $sesskey == $USER->sesskey ){
				$record = new stdClass();
				$record->rut = $editform->get_data()->rut;
				$record->name = $editform->get_data()->name;
				$record->lastname = $editform->get_data()->lastname;
				$DB->update_record("clients", $record);
				$action = "view";
			}
		}else{
			print_error(get_string("clientdoesnotexist", "local_notebookstore"));
			$action = "view";
		}
	}
}

if( $action == "delete" ){
	if( $idclients == null ){
		print_error(get_string("clientdoesnotexist", "local_notebookstore"));
		$action = "view";
	}else{
		if( $client = $DB->get_record("clients", array("rut"=>$rutclients)) ){
			if( $sesskey == $USER->sesskey ) {
				$DB->delete_records("clients", array("rut"=>$client->rut));
				$action = "view";
			}else{
				print_error(get_string("usernotloggedin", "local_notebookstore"));
			}
		}else{
			print_error(get_string("clientdoesnotexist", "local_notebookstore"));
			$action = "view";
		}
	}
}

if( $action == "view" ){
	$clients = $DB->get_records("clients");
	$clientstable = new html_table();
	if( count($clients) >0 ){
		$clientstable->head = array(
				get_string("clientsrut", "local_notebookstore"),
				get_string("clientsname", "local_notebookstore"),
				get_string("clientslastname", "local_notebookstore"),
		);
	
		foreach ($clients as $client){
			$deleteurl_clients = new moodle_url("/local/notebookstore/index.php", array(
					"action" => "delete",
					"rutclient" => $client->rut,
					"sesskey" => sesskey()
			));
			$deleteicon_clients = new pix_icon("t/delete", get_string("delete", "local_notebookstore"));
			$deleteaction_clients = $OUTPUT->action_icon(
					$deleteurl_clients,
					$deleteicon_clients,
					new confirm_action(get_string("deleteclientconfirmation", "local_notebookstore")
					));
	
			$editurl_clients = new moodle_url("/local/notebookstore/index.php", array(
					"action"=> "edit",
					"rutclient" => $client->rut,
					"sesskey" => sesskey()
			));
			$editicon_clients = new pix_icon("i/edit", get_string("edit", "local_notebookstore"));
			$editaction_clients = $OUTPUT->action_icon(
					$editurl_clients,
					$editicon_clients,
					new confirm_action(get_string("editclientconfirmation", "local_notebookstore")
					));
	
			$clientstable->data[] = array(
					$client->rut,
					$client->name,
					$client->lastname,
					$deleteaction_clients.$editaction_clients
			);
		}
		
	$buttonurl = new moodle_url("/local/notebookstore/index.php", array("action" => "add"));
		
	$toprow = array();
		$toprow[] = new tabobject(
				get_string("clients", "local_notebookstore"),
				new moodle_url("/local/notebookstore/index.php"),
				get_string("clients", "local_notebookstore")
		);
		$toprow[] = new tabobject(
				get_string("notebooks", "local_notebookstore"),
				new moodle_url("/local/notebookstore/notebooks.php"),
				get_string("notebooks", "local_notebookstore")
		);
		$toprow[] = new tabobject(
				get_string("receipts", "local_notebookstore"),
				new moodle_url("/local/notebookstore/recipts.php"),
				get_string("receipts", "local_notebookstore")
		);
	}
}

if( $action == "add" ){
	$PAGE->set_title(get_string("addclient", "local_notebookstore"));
	$PAGE->set_heading(get_string("addclient", "local_notebookstore"));
	echo $OUTPUT->heading(get_string("addclient", "local_notebookstore"));
	$addform->display();
}

if( $action == "edit" ){
	$PAGE->set_title(get_string("editclient", "local_notebookstore"));
	$PAGE->set_heading(get_string("editclient", "local_notebookstore"));
	echo $OUTPUT->heading(get_string("editclient", "local_notebookstore"));
	$editform->display();
}

if($action=="view"){
	$PAGE->set_title(get_string("title", "local_notebookstore"));
	$PAGE->set_heading(get_string("heading", "local_notebookstore"));
	echo $OUTPUT->heading(get_string("heading", "local_notebookstore"));
	echo $OUTPUT->tabtree( $toprow, get_string("clients", "local_notebookstore"));
	echo get_string("clientsinformation", "local_notebookstore");
	echo html_writer::table($clientstable);
	echo html_writer::nonempty_tag("div", $OUTPUT->single_button($buttonurl, get_string("addclient", "local_notebookstore")), array("align" => "center"));
}

echo $OUTPUT->footer();
