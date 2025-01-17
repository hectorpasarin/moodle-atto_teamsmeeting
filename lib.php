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
 * Atto text editor integration lib file.
 *
 * @package    atto_teamsmeeting
 * @copyright  2020 Enovation
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../../../../../repository/url/locallib.php');

/**
 * Set params for this button.
 *
 * @param string $elementid
 * @param stdClass $options - the options for the editor, including the context.
 * @param stdClass $fpoptions - unused.
 */
function atto_teamsmeeting_params_for_js($elementid, $options, $fpoptions) {
    global $CFG, $SESSION, $USER, $COURSE;

    $coursecontext=context_course::instance($COURSE->id);
    $disabled=false;

    // If user don't have permission don't show button
    if(!has_capability('atto/teamsmeeting:visible', $coursecontext)) {
       $disabled=true;
    }

    $params = [
        'clientdomain' => encode_url($CFG->wwwroot),
        'appurl' => get_config('atto_teamsmeeting', 'meetingapplink'),
        'locale' => (empty($SESSION->lang) ? $USER->lang : $SESSION->lang),
        'msession' => sesskey(),
        'disabled' => $disabled
    ];
    return $params;
}

/**
 * Initialise this plugin
 */
function atto_teamsmeeting_strings_for_js() {
    global $PAGE;

    $PAGE->requires->strings_for_js(array(
                                          'addlink',
                                          'createteamsmeeting',
                                          'meetingurl',
                                          'openinnewwindow'),
                                    'atto_teamsmeeting');
}

