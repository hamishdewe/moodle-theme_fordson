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
 * Main Lib file.
 *
 * @package    theme_fordson
 * @copyright  2016 Chris Kenniburg
 * @credits    theme_boost - MoodleHQ
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* THEME_fordson BUILDING NOTES
 * =============================
 * Lib functions have been split into separate files, which are called
 * from this central file. This is to aid ongoing development as I find
 * it easier to work with multiple smaller function-specific files than
 * with a single monolithic lib file. This may be a personal preference
 * and it would be quite feasible to bring all lib functions back into
 * a single central file if another developer prefered to work in that way.
 */

defined('MOODLE_INTERNAL') || die();

require('lib/scss_lib.php');
require('lib/filesettings_lib.php');
require('lib/fordson_lib.php');

/**
 * Prune the course list using any plugins that implement {type}_{plugin}_fordson_view_available_courses
 *
 * @param array $courses
 * @param bool $doaction
 * @return array
 */
function theme_fordson_override_view_available_courses($courses, $doaction = false) {
  global $CFG;

  $plugin_list = \core_plugin_manager::instance()->get_plugins();
  foreach ($plugin_list as $type => $list) {
    foreach ($list as $plugin) {
      $functionname = "{$plugin->type}_{$plugin->name}_fordson_view_available_courses";
      $lib = $plugin->rootdir . '/lib.php';
      if (file_exists($lib)) {
        include_once($lib);
        if (function_exists($functionname)) {
          $courses = $functionname($courses, $doaction);
        }
      }
    }
  }
  return $courses;
}

function theme_fordson_redirect() {
  global $COURSE, $PAGE;

  if ($PAGE->bodyid === 'page-enrol-index') {
    $courses = [];
    $courses[$COURSE->id] = $COURSE;
    theme_fordson_override_view_available_courses($courses, true);
  }
}

function theme_fordson_before_http_headers() {
  global $PAGE;
  foreach ($PAGE->categories as $cat) {
    $path = str_replace('/', '-', $cat->path);
    $PAGE->add_body_class("category-path{$path}");
    break;
  }
  return '';
}

/**
 * Get icon mapping for fontawesome.
 */
function theme_fordson_get_fontawesome_icon_map() {                                                                                     
    return [
        'mod_forum:i/pinned' => 'fa-map-pin',
        'mod_forum:t/selected' => 'fa-check',
        'mod_forum:t/subscribed' => 'fa-envelope-o',
        'mod_forum:t/unsubscribed' => 'fa-envelope-open-o',
    ];
}

theme_fordson_redirect();
