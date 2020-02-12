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

define('CLI_SCRIPT', true);

require(__DIR__ . '/../../../config.php');
require_once("{$CFG->libdir}/clilib.php");
require_once($CFG->dirroot . "/lib/filelib.php");

list($options, $unrecognized) = cli_get_params(
    [
        'help' => false,
        'channel' => '',
        'showsql' => false,
    ], [
        'h' => 'help',
    ]
);

if ($unrecognized) {
    $unrecognized = implode("\n  ", $unrecognized);
    cli_error(get_string('cliunknowoption', 'admin', $unrecognized));
}

if ($options['help']) {
    $help = <<<EOT
Ad hoc cron tasks.

Options:
 -h, --help       Print out this help
     --channel    The rocketchat channel to echo to

Example:
\$sudo -u www-data /usr/bin/php admin/tool/rocketchat/cli.php --channel='#test'

EOT;

    echo $help;
    die;
}

if ($options['channel']) {
    set_debugging(DEBUG_DEVELOPER, true);
}


tool_rocketchat\local\rocket::send();



