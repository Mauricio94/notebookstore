<?php

/**
 *
 * @package local
 * @subpackage notebookstore
 * @copyright 2015 Mauricio Meza (mameza@alumnos.uai.cl)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
require_once(dirname(dirname(dirname(__FILE__)))."/config.php");
//require_once($CFG->dirroot."/local/notebookstore/forms/index_form.php");
global $DB, $USER, $PAGE, $OUTPUT;

require_login();
if (isguestuser()) {
	die();
}

// Action = { view, edit, delete, create }, all page options
$action = optional_param("action", "view", PARAM_TEXT);
$sesskey = optional_param("sesskey", null, PARAM_ALPHANUM);

$context = context_system::instance();

$urlindex = new moodle_url("/local/notebookstore/index.php");

// Page navigation and URL settings
$PAGE->set_url($urlindex);
$PAGE->set_context($context);
$PAGE->set_pagelayout("standard");
$PAGE->set_title(get_string("title", "local_notebookstore"));
$PAGE->set_heading(get_string("heading", "local_notebookstore"));

echo $OUTPUT->header();

if( $action == "view" ){
	
	$clients = $DB->get_records("clients");	
	$clientstable = new html_table();
	if( count($clients) >0 ){
		$clientstable->head = array(
				get_string("clientsrut", "local_notebookstore"),
				get_string("clientsname", "local_notebookstore"),
				get_string("clientslastname", "local_notebookstore")
		);
	
		foreach ($clients as $client){
			$deleteurl_clients = new moodle_url("/local/notebookstore/index.php", array(
					"action" => "delete",
					"rutclients" => $clients->rut
			));
			$deleteicon_clients = new pix_icon("t/delete", get_string("delete", "local_notebookstore")); 
			$deleteaction_clients = $OUTPUT->action_icon(
					$deleteurl_clients,
					$deleteicon_clients, 
					new confirm_action(get_string("deleteclient", "local_notebookstore")
			));
			
			$editurl_clients = new moodle_url("/local/notebookstore/index.php", array(
					"action"=> "edit",
					"rutclients" => $clients->rut
			));
			$editicon_clients = new pix_icon("i/edit", get_string("edit", "local_notebookstore"));
			$editaction_clients = $OUTPUT->action_icon(
					$editurl_clients, 
					$editicon_clients, 
					new confirm_action(get_string("editclient", "local_notebookstore")
			));
	
			$clientstable->data[] = array(
					$client->rut, 
					$client->name, 
					$client->lastname, 
					$deleteaction_clients.$editaction_clients
			);
		}
	}
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

if($action=="view"){
	
	echo $OUTPUT->tabtree( $toprow, get_string("clients", "local_notebookstore"));
	echo get_string("clientstable", "local_notebookstore");
	echo html_writer::table($clientstable);
	
}

echo $OUTPUT->footer();
