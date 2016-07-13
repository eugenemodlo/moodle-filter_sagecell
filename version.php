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
 * SageCell filter for Moodle 3.1
 *
 * @package    filter_sagecell
 * @copyright  2015-2016 Eugene Modlo, Sergey Semerikov
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2016070800;        // The current plugin version (Date: YYYYMMDDXX).
$plugin->release   = 1.04;
$plugin->requires  = 2016052300;        // Requires Moodle 3.1
$plugin->component = 'filter_sagecell'; // Full name of the plugin (used for diagnostics).
$plugin->maturity  = MATURITY_STABLE;
