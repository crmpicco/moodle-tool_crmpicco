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

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/admin/tool/crmpicco/index.php', array('id' => 'asd'));
$PAGE->set_title('My modules page title - crmpicco');
$PAGE->set_heading('My modules page heading - crmpicco');

// The rest of your code goes below this.

echo "hello world<br>";

echo get_string('helloworld', 'tool_crmpicco');