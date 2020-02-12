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
 * Version details.
 *
 * @package    tool_rocketchat
 * @copyright  2020 Brendan Heywood <brendan@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_rocketchat\local;

class rocket {

    /**
     * @param $event moodle event
     */
    static public function send($event) {

        global $CFG, $SITE;
        $url = get_config('tool_rocketchat', 'hookurl');

        $curl = new \curl([
            'debug' => 0
        ]);
        $curl->setHeader(array('Content-type: application/json'));

        $user = \core_user::get_user($event->userid);
        $user = fullname($user);
        $link = $event->get_url();

        if ($link) {
            $link = $link->out();
        }

        $json = [
            'text' => $SITE->fullname . ': ' . $user,
            "attachments"=> [[
                "title"      => $event->get_name(),
                "title_link" => $link,
                "text"       => $event->get_description()
                            . "\n" . $SITE->fullname
                            . ' from ' . $CFG->wwwroot,
                "color"      => "#764FA5"
            ]]
        ];

        $post = json_encode($json);
        $curl->post($url, $post);

    }

}

