<?php

/**
 *
 * @package local
 * @subpackage notebookstore
 * @copyright 2015 Mauricio Meza (mameza@alumnos.uai.cl)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
require_once (dirname(dirname(dirname(__FILE__)))."/config.php");
require_once ($CFG->dirroot."/local/notebookstore/forms/notebooks_forms.php");
global $DB, $USER, $PAGE, $OUTPUT;

require_login();
if (isguestuser()) {
	die();
}

// Optional Parameters
$action = optional_param("action", "view", PARAM_TEXT);
$idnotebook = optional_param("idnotebook", null, PARAM_INT);
$sesskey = optional_param("sesskey", null, PARAM_ALPHANUM);

$context = context_system::instance();

$urlnotebooks = new moodle_url("/local/notebookstore/notebooks.php");

// Page specifications
$PAGE->set_url($urlnotebooks);
$PAGE->set_context($context);
$PAGE->set_pagelayout("standard");

echo $OUTPUT->header();

//Run of each action
if( $action == "add" ){
	$addform = new addnotebook_form();
	if( $addform->is_cancelled() ){
		$action = "view";
	}else if( $creationdata = $addform->get_data() ){
		$record = new stdClass();
		$record->company = $creationdata->company;
		$record->cpu = $creationdata->cpu;
		$record->ram = $creationdata->ram;
		$record->memory = $creationdata->memory;
		$record->price = $creationdata->price;
		$DB->insert_record("notebooks", $record);
		$action = "view";
	}
}

if( $action == "edit" ){
	if( $idnotebook == null ){
		print_error(get_string("notebookdoesnotexist", "local_notebookstore"));
		$action = "view";
	}else{
		if( $notebook = $DB->get_record("notebooks", array("id"=>$idnotebook)) ){
			$editform = new editnotebook_form(null, array(
					"idnotebook" => $idnotebook));
			
			$defaultdata = new stdClass();
			$defaultdata->id = $notebook->id;
			$defaultdata->company = $notebook->company;
			$defaultdata->cpu = $notebook->cpu;
			$defaultdata->ram = $notebook->ram;
			$defaultdata->memory = $notebook->memory;
			$defaultdata->price = $notebook->price;
			$editform->set_data($defaultdata);
			
			if( $editform->is_cancelled() ){
				$action = "view";
			}
			else if( $editform->get_data()  && $sesskey == $USER->sesskey ){
				$record = new stdClass();
				$record->id = $editform->get_data()->id;
				$record->company = $editform->get_data()->company;
				$record->cpu = $editform->get_data()->cpu;
				$record->ram = $editform->get_data()->ram;
				$record->memory = $editform->get_data()->memory;
				$record->price = $editform->get_data()->price;
				$DB->update_record("notebooks", $record);
				$action = "view";
			}
		}else{
			print_error(get_string("notebookdoesnotexist", "local_notebookstore"));
			$action = "view";
		}
	}
}

if( $action == "delete" ){
	if( $idnotebook == null ){
		print_error(get_string("notebookdoesnotexist", "local_notebookstore"));
		$action = "view";
	}else{
		if( $notebook = $DB->get_record("notebooks", array("id"=>$idnotebook)) ){
			if( $sesskey == $USER->sesskey ) {
				$DB->delete_records("notebooks", array("id"=>$notebook->id));
				$action = "view";
			}else{
				print_error(get_string("usernotloggedin", "local_notebookstore"));
			}
		}else{
			print_error(get_string("notebookdoesnotexist", "local_notebookstore"));
			$action = "view";
		}
	}
}


if( $action == "view" ){
	$notebooks = $DB->get_records("notebooks");
	$notebookstable = new html_table();
	if( count($notebooks) >0 ){
		$notebookstable->head = array(
				get_string("notebooksid", "local_notebookstore"),
				get_string("notebookscompany", "local_notebookstore"),
				get_string("notebookscpu", "local_notebookstore"),
				get_string("notebooksram", "local_notebookstore"),
				get_string("notebooksmemory", "local_notebookstore"),
				get_string("notebooksprice", "local_notebookstore")
		);
	
		foreach ($notebooks as $notebook){
			$deleteurl_notebooks = new moodle_url("/local/notebookstore/notebooks.php", array(
					"action" => "delete",
					"idnotebook" => $notebook->id,
					"sesskey" => sesskey()
			));
			$deleteicon_notebooks = new pix_icon("t/delete", get_string("delete", "local_notebookstore"));
			$deleteaction_notebooks = $OUTPUT->action_icon(
					$deleteurl_notebooks,
					$deleteicon_notebooks,
					new confirm_action(get_string("deletenotebookconfirmation", "local_notebookstore")
					));
	
			$editurl_notebooks = new moodle_url("/local/notebookstore/notebooks.php", array(
					"action"=> "edit",
					"idnotebook" => $notebook->id,
					"sesskey" => sesskey()
			));
			$editicon_notebooks = new pix_icon("i/edit", get_string("edit", "local_notebookstore"));
			$editaction_notebooks = $OUTPUT->action_icon(
					$editurl_notebooks,
					$editicon_notebooks,
					new confirm_action(get_string("editnotebooksconfirmation", "local_notebookstore")
					));
	
			$notebookstable->data[] = array(
					$notebook->id,
					$notebook->company,
					$notebook->cpu,
					$notebook->ram,
					$notebook->memory,
					$notebook->price,
					$deleteaction_notebooks.$editaction_notebooks
			);
		}
		
	$buttonurl = new moodle_url("/local/notebookstore/notebooks.php", array("action" => "add"));
		
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
				new moodle_url("/local/notebookstore/receipts.php"),
				get_string("receipts", "local_notebookstore")
		);
	}
}

//Display of each action
if( $action == "add" ){
	$PAGE->set_title(get_string("addnotebook", "local_notebookstore"));
	$PAGE->set_heading(get_string("addnotebook", "local_notebookstore"));
	echo $OUTPUT->heading(get_string("addnotebook", "local_notebookstore"));
	$addform->display();
}

if( $action == "edit" ){
	$PAGE->set_title(get_string("editnotebook", "local_notebookstore"));
	$PAGE->set_heading(get_string("editnotebook", "local_notebookstore"));
	echo $OUTPUT->heading(get_string("editnotebook", "local_notebookstore"));
	$editform->display();
}

if($action=="view"){
	$PAGE->set_title(get_string("title", "local_notebookstore"));
	$PAGE->set_heading(get_string("heading", "local_notebookstore"));
	echo $OUTPUT->heading(get_string("heading", "local_notebookstore"));
	echo $OUTPUT->tabtree( $toprow, get_string("notebooks", "local_notebookstore"));
	echo get_string("notebooksinformation", "local_notebookstore");
	echo html_writer::table($notebookstable);
	echo html_writer::nonempty_tag("div", $OUTPUT->single_button($buttonurl, get_string("addnotebook", "local_notebookstore")), array("align" => "center"));
	
}

echo $OUTPUT->footer();
		