<?php

/*
 * __________________________________________________________________________
 *
 * SageCell filter for Moodle 2.0
 *
 *  This filter will replace any Sage code in [sagecell]...[/sagecell] 
 *  with a Ajax code from http://sagecell.sagemath.org
 *
 * @package    filter
 * @subpackage sagecell
 * @copyright  2015 Eugene Modlo, Sergey Semerikov  {@link http://modlo.ccjournals.eu}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * __________________________________________________________________________
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2015041700;
$plugin->release   = 1.0;
$plugin->requires  = 2010112400;      
$plugin->component = 'filter_sagecell'; 