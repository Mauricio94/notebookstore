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

if ($oldversion < 2015090405) {

	// Define table receipt to be created.
	$table = new xmldb_table('receipt');

	// Adding fields to table receipt.
	$table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
	$table->add_field('clients_rut', XMLDB_TYPE_INTEGER, '8', null, XMLDB_NOTNULL, null, null);
	$table->add_field('notebooks_id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);

	// Adding keys to table receipt.
	$table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

	// Conditionally launch create table for receipt.
	if (!$dbman->table_exists($table)) {
		$dbman->create_table($table);
	}

	// Notebookstore savepoint reached.
	upgrade_plugin_savepoint(true, 2015090405, 'local', 'notebookstore');
}

  	if ($oldversion < 2015090405) {

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
        upgrade_plugin_savepoint(true, 2015090405, 'local', 'notebookstore');
    }
    
    if ($oldversion < 2015090405) {
    
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
    	upgrade_plugin_savepoint(true, 2015090405, 'local', 'notebookstore');
    }
 
return true;
}