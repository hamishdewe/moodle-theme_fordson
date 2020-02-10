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
 * Colours settings page file.
 *
 * @packagetheme_fordson
 * @copyright  2016 Chris Kenniburg
 * @creditstheme_fordson - MoodleHQ
 * @licensehttp://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_fordson_fonts', get_string('fontdesignheadingsetting', 'theme_fordson'));

  // Settings title to group font related settings together with a common heading. We don't want a description here.
  $name = 'theme_fordson_fonts/fontdesignheading';
  $title = get_string('fontdesignheadingsetting', 'theme_fordson', null, true);
  $setting = new admin_setting_heading($name, $title, null);
  $page->add($setting);

  // Font files upload.
  $name = 'theme_fordson/fontfiles';
  $title = get_string('fontfilessetting', 'theme_fordson', null, true);
  $description = get_string('fontfilessetting_desc', 'theme_fordson', null, true);
  $setting = new admin_setting_configstoredfile($name, $title, $description, 'fontfiles', 0,
          array('maxfiles' => 100, 'accepted_types' => array('.ttf', '.eot', '.woff', '.woff2')));
  $setting->set_updatedcallback('theme_reset_all_caches');
  $page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);
