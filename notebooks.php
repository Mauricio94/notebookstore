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
	$notebooks = $DB->get_records("notebooks");
	$notebookstable = new html_table();
	if( count($notebooks) >0 ){
		$notebookstable->head = array(
				get_string("notebooksid", "local_notebookstore"),
				get_string("notebookscompany", "local_notebookstore"),
				get_string("notebookscpu", "local_notebookstore"),
				get_string("notebooksram", "local_notebookstore"),
				get_string("notebooksmemory", "local_notebookstore")
		);
	
		foreach ($notebooks as $notebook){
			$deleteurl_clients = new moodle_url("/local/notebookstore/notebooks.php", array(
					"action" => "delete",
					"idnotebooks" => $notebooks->id,
					"sesskey" => sesskey()
			));
			$deleteicon_notebooks = new pix_icon("t/delete", get_string("delete", "local_notebookstore"));
			$deleteaction_notebooks = $OUTPUT->action_icon(
					$deleteurl_notebooks,
					$deleteicon_notebooks,
					new confirm_action(get_string("deletenotebooks", "local_notebookstore")
					));
	
			$editurl_notebooks = new moodle_url("/local/notebookstore/notebooks.php", array(
					"action"=> "edit",
					"idnotebooks" => $notebooks->id,
					"sesskey" => sesskey()
			));
			$editicon_notebooks = new pix_icon("i/edit", get_string("edit", "local_notebookstore"));
			$editaction_notebooks = $OUTPUT->action_icon(
					$editurl_notebooks,
					$editicon_notebooks,
					new confirm_action(get_string("editnotebooks", "local_notebookstore")
					));
	
			$notebookstable->data[] = array(
					$notebook->id,
					$notebook->company,
					$notebook->cpu,
					$notebook->ram,
					$notebook->memory,
					$deleteaction_notebooks.$editaction_notebooks
			);
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
}

if($action=="view"){
	
	echo $OUTPUT->tabtree( $toprow, get_string("notebooks", "local_notebooks"));
	echo get_string("notebookstable", "local_notebookstore");
	echo html_writer::table($notebookstable);
	
}

echo $OUTPUT->footer();
		