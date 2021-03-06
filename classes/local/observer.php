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
 * A rocketchat event notifier
 *
 * @package    tool_rocketchat
 * @copyright  2020 Brendan Heywood <brendan@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_rocketchat\local;

defined('MOODLE_INTERNAL') || die();

/**
 * A rocketchat event notifier
 *
 * @package    tool_rocketchat
 * @copyright  2020 Brendan Heywood <brendan@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class observer {

    /**
     * Send selected events to rocketchat
     *
     * @param \core\event\base $event
     */
    public static function notify(\core\event\base $event) {

        $whitelist = get_config('tool_rocketchat', 'events');
        $whitelist = explode(PHP_EOL, $whitelist);
        foreach ($whitelist as $line) {
            $parts = explode(',', trim($line));
            $allowed = array_shift($parts);
            if (empty($parts)) {
                $parts = ['']; // If empty use default channel.
            }
            if ($allowed == $event->eventname) {
                foreach ($parts as $channel) {
                    \tool_rocketchat\local\rocket::send($event, $channel);
                }
                return;
            }
        }

    }
}
