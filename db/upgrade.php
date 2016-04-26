<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 26/04/16
 * Time: 1:29 PM
 */

function xmldb_tool_crmpicco_upgrade($oldversion) {

    global $DB;
    $dbman = $DB->get_manager();

//    echo "oldversion: " . $oldversion . "<br>";

    if ($oldversion < 2016042201) {

        // Define table tool_crmpicco to be created.
        $table = new xmldb_table('tool_crmpicco');

        // Adding fields to table tool_crmpicco.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('courseid', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('name', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('completed', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('priority', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '1');
        $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', null, null, null, null);

        // Adding keys to table tool_crmpicco.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        // Conditionally launch create table for tool_crmpicco.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Crmpicco savepoint reached.
        upgrade_plugin_savepoint(true, 2016042201, 'tool', 'crmpicco');
    }

    if ($oldversion < 2016042602) {

        // Define table tool_crmpicco to be created.
        $table = new xmldb_table('tool_crmpicco');

        // Adding keys to table tool_crmpicco.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->add_key('courseid', XMLDB_KEY_FOREIGN, array('courseid'), 'course', array('id'));

        // Adding indexes to table tool_crmpicco.
        $table->add_index('courseidname', XMLDB_INDEX_UNIQUE, array('courseid', 'name'));

        // Crmpicco savepoint reached.
        upgrade_plugin_savepoint(true, 2016042602, 'tool', 'crmpicco');
    }

}