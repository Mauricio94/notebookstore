<?php
require_once (dirname(dirname(dirname(__FILE__)))."/config.php");
global $DB, $USER,$PAGE, $OUTPUT;

require_login();
if (isguestuser()) {
	die();
}

// Optional Parameters
$action = optional_param("action", "view", PARAM_TEXT);
$rutclient = optional_param("rutclient", null, PARAM_INT);
$sesskey = optional_param("sesskey", null, PARAM_ALPHANUM);

$context = context_system::instance();

$urlindex = new moodle_url("/local/notebookstore/asd.php");

// Page specification
$PAGE->set_url($urlindex);
$PAGE->set_context($context);
$PAGE->set_pagelayout("standard");

echo $OUTPUT->header();

$table = new html_table();
	
$table->head = array(
		"ID_Curso",
		"Numero de alumnos",
		"N° alumnos que ejercitan",
		"Porcentaje de alumnos que ejercitan",
		"Cantidad total de Ejercitacion",
		"N° Prom. de Ejercitacion de alumnos activos",
		"N° alumnos que ejercitan",
		"Porcentaje de alumnos que ejercitan",
		"Cantidad total de Ejercitacion",
		"N° Prom. de Ejercitacion de alumnos activos");

$table->data[] = array(
		"S1",
		"51",
		"12",
		"24%",
		"14",
		"1.2",
		"3",
		"6%",
		"8",
		"2.7");

$table->data[] = array(
		"S2",
		"50",
		"10",
		"20%",
		"15",
		"1.5",
		"7",
		"14%",
		"9",
		"1.3");

$table->data[] = array(
		"S3",
		"50",
		"13",
		"26%",
		"15",
		"1.2",
		"5",
		"10%",
		"5",
		"1.0");

$table->data[] = array(
		"S4",
		"50",
		"6",
		"12%",
		"6",
		"1.0",
		"1",
		"2%",
		"1",
		"1.0");

$table->data[] = array(
		"S5",
		"50",
		"2",
		"4%",
		"2",
		"1.0",
		"0",
		"0%",
		"0",
		"0.0");

$table->data[] = array(
		"S6",
		"55",
		"3",
		"5%",
		"6",
		"2.0",
		"2",
		"4%",
		"3",
		"1.5");

$table->data[] = array(
		"S7",
		"49",
		"5",
		"10%",
		"5",
		"1.0",
		"1",
		"2%",
		"1",
		"1.0");

$table->data[] = array(
		"S8",
		"55",
		"6",
		"11%",
		"6",
		"1.0",
		"4",
		"7%",
		"9",
		"2.3");

$table->data[] = array(
		"S9",
		"49",
		"7",
		"14%",
		"11",
		"1.6",
		"3",
		"6%",
		"3",
		"1.0");

$table->data[] = array(
		"S10",
		"50",
		"14",
		"28%",
		"20",
		"1.4",
		"9",
		"18%",
		"10",
		"1.1");

$table->data[] = array(
		"S11",
		"50",
		"9",
		"18%",
		"10",
		"1.1",
		"2",
		"4%",
		"2",
		"1.0");

$table->data[] = array(
		"S12",
		"50",
		"10",
		"20%",
		"13",
		"1.3",
		"4",
		"8%",
		"4",
		"1.0");

$table->data[] = array(
		"V1",
		"54",
		"7",
		"13%",
		"19",
		"2.7",
		"7",
		"13%",
		"8",
		"1.1");
		
$table->data[] = array(
		"V2",
		"57",
		"8",
		"14%",
		"19",
		"2.4",
		"6",
		"11%",
		"11",
		"1.8");

$table->data[] = array(
		"V3",
		"54",
		"8",
		"15%",
		"16",
		"2.0",
		"5",
		"9%",
		"5",
		"1.0");

$table->data[] = array(
		"V4",
		"53",
		"15",
		"28%",
		"16",
		"1.1",
		"3",
		"6%",
		"3",
		"1.0");

$table->data[] = array(
		"V5",
		"54",
		"2",
		"4%",
		"2",
		"1.0",
		"0",
		"0%",
		"0",
		"0.0");

$table->data[] = array(
		"Total o Promedio",
		"881",
		"137",
		"16%",
		"195",
		"1.0",
		"62",
		"7%",
		"82",
		"1");


echo html_writer::table($table);

echo $OUTPUT->footer();