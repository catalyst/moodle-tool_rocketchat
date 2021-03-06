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

$string['pluginname'] = 'Rocketchat events';
$string['events'] = 'Events';
$string['eventshelp'] = "<p>A list of event classes to send to rocketchat and optionally what channel(s). Each class may be followed by a comma separated list of channels which override the default channel defined in the Webhook</p><pre>
\\tool_rocketchat\\event\\rocketchat_test
\\tool_rocketchat\\event\\rocketchat_test,#channel1
\\tool_rocketchat\\event\\rocketchat_test,#channel1,#channel2</pre>";
$string['eventtest'] = 'A rocketchat connection test';
$string['hookurl'] = 'Webhook URL';
$string['hookurlhelp'] = "Copy the full Webhook URL from the Rocketchat 'Incoming WebHook Integration' page. It will look something like:\nhttps://rocketchat.com/hooks/123456789/zxcasdqweertdfhcvn";
$string['textformat'] = '{$a->name} by {$a->username} ({$a->userid}) in {$a->sitefullname} ({$a->wwwroot})';

/*
 * Privacy provider (GDPR)
 */
$string["privacy:no_data_reason"] = "The rocketchat plugin does not store any personal data, but may be configured to export private data to rocketchat.";
