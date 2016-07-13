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
 *  This filter will replace any Sage code in [sage]...[/sage]
 *  with a Ajax code from http://sagecell.sagemath.org
 *
 * @package    filter_sagecell
 * @copyright  2015-2016 Eugene Modlo, Sergey Semerikov
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Automatic SageCell embedding filter class.
 *
 * @package    filter_sagecell
 * @copyright  2015-2016 Eugene Modlo, Sergey Semerikov
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class filter_sagecell extends moodle_text_filter {

    /**
     * Check text for Sage code in [sage]...[/sage].
     *
     * @param string $text
     * @param array $options
     * @return string
     */
    public function filter($text, array $options = array()) {

        if (!is_string($text) or empty($text)) {
            // Non string data can not be filtered anyway.
            return $text;
        }

        if (strpos($text, '[sage]') === false) {
            // Performance shortcut - if there is no </a> tag, nothing can match.
            return $text;
        }

        $newtext = $text; // Fullclone is slow and not needed here.

        $search = '/\[sage](.+?)\[\/sage]/is';
        $newtext = preg_replace_callback($search, 'filter_sagecell_callback', $newtext);

        if (is_null($newtext) or $newtext === $text) {
            // Error or not filtered.
            return $text;
        }

        return $newtext;
    }

}

/**
 * Replace Sage code with embedded SageCell, if possible.
 *
 * @param array $sagecode
 * @return string
 */
function filter_sagecell_callback($sagecode) {

    // SageCell code from [sage]...[/sage].
    $output = $sagecode[1];
    //$output = substr($sagecode[0], strlen("[sage]"), strlen($sagecode[0]) - strlen("[/sage]") - strlen("[sage]"));
    //$output = preg_replace("/\<script.*?\<\/script\>/", "", $output);
    $output = str_ireplace("<p>", "\n", $output);
    $output = str_ireplace("</p>", "\n", $output);
    $output = str_ireplace("<br>", "\n", $output);
    $output = str_ireplace("<br/>", "\n", $output);
    $output = str_ireplace("<br />", "\n", $output);
    $output = str_ireplace("&nbsp;", "\x20", $output);
    $output = str_ireplace("\xc2\xa0", "\x20", $output);
    //$output = html_entity_decode(strip_tags($output));

    $output = "<script src=\"http://sagecell.sagemath.org/static/jquery.min.js\"></script>" .
    "<script src=\"http://sagecell.sagemath.org/embedded_sagecell.js\"></script>" .
    "<script>" .
    "$(function () {" .
        "sagecell.makeSagecell({inputLocation: \"div.compute\"," .
        "evalButtonText: \"Evaluate\"," .
        "autoeval: true," .
        "hide: [\"evalButton\", \"editor\", \"messages\", \"permalink\", \"language\"] }" .
    ");" .
    "});" .
    "</script>" .
    "<div class=\"compute\"><script type=\"text/x-sage\">".clean_text($output)."</script></div>";

    return $output;
}
