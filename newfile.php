<?php
require_once (dirname(dirname(dirname(__FILE__)))."/config.php");
global $DB, $USER, $PAGE, $OUTPUT;

require_login();
if (isguestuser()) {
	die();
}

// Optional Parameters
$action = optional_param("action", "view", PARAM_TEXT);
$rutclient = optional_param("rutclient", null, PARAM_INT);
$sesskey = optional_param("sesskey", null, PARAM_ALPHANUM);

$context = context_system::instance();

$urlindex = new moodle_url("/local/notebookstore/newfile.php");

// Page specification
$PAGE->set_url($urlindex);
$PAGE->set_context($context);
$PAGE->set_pagelayout("standard");

echo $OUTPUT->header();

$table = new html_table();
$table->head = array(
		"ID_Curso",
		"Numero de Ejercitacion",
		"1.a.-Funciones proposicionales y cuantificadoras",
		"1.b.-Proposiciones directas, inversa, reciproca y contrareciproca");
		
$table->data[] = array(
		"S1",
		"40",
		"76%",
		"67%");

$table->data[] = array(
		"S2",
		"18",
		"71%",
		"73%");

$table->data[] = array(
		"S3",
		"17",
		"75%",
		"100%");
		
$table->data[] = array(
		"S4",
		"7",
		"100%",
		"70%");

$table->data[] = array(
		"S5",
		"32",
		"64%",
		"66%");

$table->data[] = array(
		"S6",
		"8",
		"94%",
		"88%");
		
$table->data[] = array(
		"S7",
		"5",
		"65%",
		"49%");

$table->data[] = array(
		"S8",
		"22",
		"58%",
		"55%");

$table->data[] = array(
		"S9",
		"26",
		"74%",
		"63%");

$table->data[] = array(
		"S10",
		"3",
		"83%",
		"58%");

$table->data[] = array(
		"S11",
		"23",
		"60%",
		"56%");

$table->data[] = array(
		"V1",
		"10",
		"35%",
		"33%");

$table->data[] = array(
		"V2",
		"62",
		"85%",
		"74%");

$table->data[] = array(
		"V3",
		"20",
		"66%",
		"62%");

$table->data[] = array(
		"V4",
		"18",
		"81%",
		"63%");

$table->data[] = array(
		"Total",
		"311",
		"73%",
		"66%");

echo html_writer::table($table);

echo $OUTPUT->footer();