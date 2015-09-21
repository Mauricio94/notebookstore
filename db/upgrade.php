<?php 

/**
* @package local
* @subpackage notebookstore
* @copyright 2015 Mauricio Meza (mameza@alumnos.uai.cl)
* @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

function xmldb_local_notebookstore_upgrade($oldversion) {
global $CFG, $DB;
$dbman = $DB->get_manager();

if ($oldversion < 2015090903) {

	// Define table notebooks to be created.
	$table = new xmldb_table('notebooks');

	// Adding fields to table notebooks.
	$table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
	$table->add_field('company', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
	$table->add_field('cpu', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
	$table->add_field('ram', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
	$table->add_field('memory', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);

	// Adding keys to table notebooks.
	$table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

	// Conditionally launch create table for notebooks.
	if (!$dbman->table_exists($table)) {
		$dbman->create_table($table);
	}

	// Notebookstore savepoint reached.
	upgrade_plugin_savepoint(true, 2015090903, 'local', 'notebookstore');
}

if ($oldversion < 2015090904) {

	// Define table clients to be created.
	$table = new xmldb_table('clients');

	// Adding fields to table clients.
	$table->add_field('rut', XMLDB_TYPE_INTEGER, '8', null, XMLDB_NOTNULL, null, null);
	$table->add_field('name', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
	$table->add_field('lastname', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);

	// Adding keys to table clients.
	$table->add_key('primary', XMLDB_KEY_PRIMARY, array('rut'));

	// Conditionally launch create table for clients.
	if (!$dbman->table_exists($table)) {
		$dbman->create_table($table);
	}

	// Notebookstore savepoint reached.
	upgrade_plugin_savepoint(true, 2015090904, 'local', 'notebookstore');
}

if ($oldversion < 2015090905) {

	// Define table receipts to be created.
	$table = new xmldb_table('receipts');

	// Adding fields to table receipts.
	$table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
	$table->add_field('notebooksid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
	$table->add_field('clientsrut', XMLDB_TYPE_INTEGER, '8', null, XMLDB_NOTNULL, null, null);

	// Adding keys to table receipts.
	$table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

	// Conditionally launch create table for receipts.
	if (!$dbman->table_exists($table)) {
		$dbman->create_table($table);
	}

	// Notebookstore savepoint reached.
	upgrade_plugin_savepoint(true, 2015090905, 'local', 'notebookstore');
}

if ($oldversion < 2015091502) {

        // Define field price to be added to notebooks.
        $table = new xmldb_table('notebooks');
        $field = new xmldb_field('price', XMLDB_TYPE_INTEGER, '7', null, null, null, null, 'memory');

        // Conditionally launch add field price.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Notebookstore savepoint reached.
        upgrade_plugin_savepoint(true, 2015091502, 'local', 'notebookstore');
}

if ($oldversion < 2015091503) {

	// Changing nullability of field price on table notebooks to not null.
	$table = new xmldb_table('notebooks');
	$field = new xmldb_field('price', XMLDB_TYPE_INTEGER, '7', null, XMLDB_NOTNULL, null, null, 'memory');

	// Launch change of nullability for field price.
	$dbman->change_field_notnull($table, $field);

	// Notebookstore savepoint reached.
	upgrade_plugin_savepoint(true, 2015091503, 'local', 'notebookstore');
}

return true;
}