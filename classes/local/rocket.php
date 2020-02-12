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
 * Thin rocket web hook client
 *
 * @package    tool_rocketchat
 * @copyright  2020 Brendan Heywood <brendan@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_rocketchat\local;

defined('MOODLE_INTERNAL') || die();

/**
 * Thin rocket web hook client
 *
 * @package    tool_rocketchat
 * @copyright  2020 Brendan Heywood <brendan@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class rocket {

    /**
     * Send a moodle event to rocketchat
     *
     * @param \core\event\base $event the event to send
     * @param string $channel the channel to notify
     */
    static public function send($event, $channel = '') {

        global $CFG, $SITE;
        $url = get_config('tool_rocketchat', 'hookurl');

        $curl = new \curl(['debug' => 0]);
        $curl->setHeader(array('Content-type: application/json'));

        $user = \core_user::get_user($event->userid);
        $name = fullname($user);
        $link = $event->get_url();

        if ($link) {
            $link = $link->out();
        } else {
            $link = $CFG->wwwroot;
        }

        $json = [
            'text'        => get_string('textformat', 'tool_rocketchat', [
                'name'          => $event->get_name(),
                'username'      => $name,
                'userid'        => $user->id,
                'sitefullname'  => $SITE->fullname,
                'wwwroot'       => $CFG->wwwroot,
            ]),
            'channel'     => $channel,
            'attachments' => [[
                'title'      => $event->get_description(),
                'title_link' => $link,
                'text'       => $link,
            ]]
        ];

        $post = json_encode($json);

        $result = $curl->post($url, $post, [
            'timeout' => 5, // This is a blocking call so worst case timeout very quickly.
        ]);
        if ($result !== true) {
            $error_text = $result;
            $errno = $curl->get_errno();
            debugging("tool_rocketchat error '$result', $errno");
        }

    }

}

