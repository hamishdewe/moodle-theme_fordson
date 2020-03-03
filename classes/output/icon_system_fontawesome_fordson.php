<?php

namespace theme_fordson\output;

defined('MOODLE_INTERNAL') || die();

class icon_system_fontawesome_fordson extends \core\output\icon_system_fontawesome {
    public function get_core_icon_map() {
        $map = parent::get_core_icon_map();
        $map['core:i/navigationitem'] = 'fa-caret-right';
        $map['core:i/alert'] = 'fa-caret-right';
        return $map;
    }
}
