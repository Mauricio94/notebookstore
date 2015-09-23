<?php

/**
 *
 * @package local
 * @subpackage notebookstore
 * @copyright 2015 Mauricio Meza (mameza@alumnos.uai.cl)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(__FILE__)))."/config.php");
require_once($CFG->dirroot."/local/notebookstore/forms/index_form.php");
global $DB, $USER, $PAGE, $OUTPUT;

require_login();
if (isguestuser()) {
	die();
}

// Action = { view, edit, delete, create }, all page options
$action = optional_param("action", "view", PARAM_TEXT);
$idreceipt = optional_param("idreceipt", null, PARAM_INT);
$sesskey = optional_param("sesskey", null, PARAM_ALPHANUM);

$context = context_system::instance();

$urlreceipts = new moodle_url("/local/notebookstore/receipts.php");

// Page navigation and URL settings
$PAGE->set_url($urlreceipts);
$PAGE->set_context($context);
$PAGE->set_pagelayout("standard");

echo $OUTPUT->header();

if( $action == "add" ){
	$addform = new addreceipt_form();
	if( $addform->is_cancelled() ){
		$action = "view";
	}else if( $creationdata = $addform->get_data() ){
		$selectusers = $creationdata->users;
		$DB->insert_record("notebooks", $record);
		$action = "view";
	}
}

if( $action == "delete" ){
	if( $idreceipt == null ){
		print_error(get_string("receiptdoesnotexist", "local_notebookstore"));
		$action = "view";
	}else{
		if( $receipt = $DB->get_record("receipts", array("id"=>$idreceipt)) ){
			if( $sesskey == $USER->sesskey ) {
				$DB->delete_records("receipts", array("id"=>$receipt->id));
				$action = "view";
			}else{
				print_error(get_string("usernotloggedin", "local_notebookstore"));
			}
		}else{
			print_error(get_string("receiptdoesnotexist", "local_notebookstore"));
			$action = "view";
		}
	}
}

if( $action == "view" ){
	$receipts = $DB->get_records_sql(
									"SELECT a.id, c.name, c.lastname, a.price
									FROM mdl_clients c
									INNER JOIN (SELECT r.id, r.clientsrut, n.price
												FROM mdl_receipts r
            									INNER JOIN mdl_notebooks n
            									WHERE n.id = r.notebooksid) a
									WHERE a.clientsrut = c.rut"
									 );
	$receiptstable = new html_table();
	if( count($receipts) >0 ){
		$receiptstable->head = array(
				get_string("receiptsid", "local_notebookstore"),
				get_string("clientsname", "local_notebookstore"),
				get_string("clientslastname", "local_notebookstore"),
				get_string("notebooksprice", "local_notebookstore"),
		);
	
		foreach ($receipts as $receipt){
			$deleteurl_receipts = new moodle_url("/local/notebookstore/receipts.php", array(
					"action" => "delete",
					"idreceipt" => $receipt->id,
					"sesskey" => sesskey()
			));
			$deleteicon_receipts = new pix_icon("t/delete", get_string("delete", "local_notebookstore"));
			$deleteaction_receipts = $OUTPUT->action_icon(
					$deleteurl_receipts,
					$deleteicon_receipts,
					new confirm_action(get_string("deletereceiptconfirmation", "local_notebookstore")
					));
	
			$editurl_receipts = new moodle_url("/local/notebookstore/receipts.php", array(
					"action"=> "edit",
					"idreceipt" => $receipt->id,
					"sesskey" => sesskey()
			));
			$editicon_receipts = new pix_icon("i/edit", get_string("edit", "local_notebookstore"));
			$editaction_receipts = $OUTPUT->action_icon(
					$editurl_receipts,
					$editicon_receipts,
					new confirm_action(get_string("editreceiptconfirmation", "local_notebookstore")
					));
	
			$receiptstable->data[] = array(
					$receipt->id,
					$receipt->name,
					$receipt->lastname,
					$receipt->price,
					$deleteaction_receipts.$editaction_receipts
			);
		}
		
	$buttonurl = new moodle_url("/local/notebookstore/receipts.php", array("action" => "add"));
		
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

if($action=="view"){
	$PAGE->set_title(get_string("title", "local_notebookstore"));
	$PAGE->set_heading(get_string("heading", "local_notebookstore"));
	echo $OUTPUT->heading(get_string("heading", "local_notebookstore"));
	echo $OUTPUT->tabtree( $toprow, get_string("receipts", "local_notebookstore"));
	echo get_string("receiptsinformation", "local_notebookstore");
	echo html_writer::table($receiptstable);
	echo html_writer::nonempty_tag("div", $OUTPUT->single_button($buttonurl, get_string("addreceipt", "local_notebookstore")), array("align" => "center"));
	
}

echo $OUTPUT->footer();