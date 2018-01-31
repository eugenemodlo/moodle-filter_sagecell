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
 * SageCell filter for Moodle 3.4+
 *
 * @package    filter_sagecell
 * @copyright  2015-2018 Eugene Modlo, Sergey Semerikov
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    // Root url of a SageMathCell server.
    $settings->add(new admin_setting_configtext('filter_sagecell/server',
                    get_string('sagecell_server', 'filter_sagecell'),
                    get_string('sagecell_server_desc', 'filter_sagecell'),
                    'sagecell.sagemath.org',
                    PARAM_NOTAGS));
}
