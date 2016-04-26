<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @copyright 2016, Craig R Morton <craig@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/tablelib.php');
require_once('lib.php');

$courseid = required_param('id', PARAM_INT);

$title = 'My modules page title - crmpicco';

$course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
require_course_login($course);

$PAGE->set_context(context_course::instance($course->id));
$PAGE->set_url('/admin/tool/crmpicco/index.php', array('id' => $courseid));
$PAGE->set_pagelayout('report');
$PAGE->set_title($title);
$PAGE->set_heading($title);

// The rest of your code goes below this.

// count the number of registered users
$numberofusers = $DB->count_records('user', array('confirmed' => 1));

echo $OUTPUT->header();

echo "hello world<br>";

echo "The number of registered users is " . $numberofusers . "<br>";

// display information about the current course
echo html_writer::start_div('courseid') . 'Course ID: ' . $course->id . html_writer::end_div();
echo html_writer::start_div('coursename') . 'Course Name: ' . $course->fullname . html_writer::end_div();
echo html_writer::start_div('coursename') . 'Course Start Date: ' . userdate($course->startdate) . html_writer::end_div();

echo get_string('helloworld', 'tool_crmpicco') . "<br>";

echo html_writer::start_span() . get_string('helloworld', 'tool_crmpicco') . html_writer::end_span();

$table = new tool_crmpicco\tool_crmpicco_table(uniqid(), new moodle_url('/admin/tool/crmpicco/index.php'));
echo $table->out(50, true);

if ($table->rawdata) {

    echo html_writer::start_tag('table');

    echo html_writer::start_tag('tr');
    echo html_writer::start_tag('td');
    echo get_string('name');
    echo html_writer::end_tag('td');
    echo html_writer::start_tag('td');
    echo get_string('completed', 'tool_crmpicco');
    echo html_writer::end_tag('td');
    echo html_writer::start_tag('td');
    echo get_string('priority', 'tool_crmpicco');
    echo html_writer::end_tag('td');
    echo html_writer::end_tag('tr');


    foreach ($table->rawdata as $result) {
        echo html_writer::start_tag('tr');
        echo html_writer::start_tag('td');
        echo $result->name;
        echo html_writer::end_tag('td');
        echo html_writer::start_tag('td');
        echo ($result->completed == 1 ? get_string('yes') : get_string('no'));
        echo html_writer::end_tag('td');
        echo html_writer::start_tag('td');
        echo $result->priority;
        echo html_writer::end_tag('td');
        echo html_writer::end_tag('tr');
    }

    echo html_writer::end_tag('table');
}

//echo "<pre>";
//print_r($table);
//echo "</pre>";
//echo "<br>";

echo $OUTPUT->footer();