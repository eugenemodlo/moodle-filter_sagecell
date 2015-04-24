<?php 


/*
 * __________________________________________________________________________
 *
 * Sagecell License
 * 
 * Most of the files in this repository are individually licensed with
 * the modified BSD license:
 * 
 * Copyright (c) 2011, Jason Grout, Ira Hanson, Alex Kramer, William Stein
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are
 * met:
 * 
 *   a. Redistributions of source code must retain the above copyright
 *      notice, this list of conditions and the following disclaimer.
 * 
 *   b. Redistributions in binary form must reproduce the above copyright
 *      notice, this list of conditions and the following disclaimer in
 *      the documentation and/or other materials provided with the
 *      distribution.
 * 
 *   c. Neither the name of the Sage Cell project nor the names of its
 *      contributors may be used to endorse or promote products derived
 *      from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 * 
 * Some files (like interact_compatibility.py and interact_sagecell.py)
 * are licensed GPLv2+ for the sole reason that they import Sage GPLv2+
 * code (see the header for those files).  If those imports are removed,
 * the files may be licensed with the modified BSD license.
 * 
 * Since this package includes GPLv2+ code (namely those files above),
 * the repository as a whole is licensed GPLv2+.
 *
 * __________________________________________________________________________
 */


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

class filter_sagecell extends moodle_text_filter {

    function filter($text, array $options = array()) {
        global $PAGE;

        if (!is_string($text)) {
            // non string data can not be filtered anyway
            return $text;
        }

        $newtext = $text; // fullclone is slow and not needed here

        $search = '/\[sagecell][^\[]+\[\/sagecell]/is';
        $newtext = preg_replace_callback($search, 'filter_sagecell_callback', $newtext);

        if (is_null($newtext) or $newtext === $text) {
            // error or not filtered
            return $text;
        }

        return $newtext;
    }
}



function filter_sagecell_callback($sagecode) {
    $output=substr($sagecode[0], strlen("[sagecell]"), strlen($sagecode)-strlen("[/sagecell]"));
    $output=str_ireplace("<p>","\n",$output);
    $output=str_ireplace("</p>","\n",$output);
    $output=str_ireplace("<br>","\n",$output);
    $output=str_ireplace("&nbsp;"," ",$output);
    $output=html_entity_decode(strip_tags($output));
    //echo "<script>alert("$sagecode[0]");</script>";
    //echo "<script>alert("$output");</script>";

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
    "<div class=\"compute\"><script type=\"text/x-sage\">".$output."</script></div>";

  //  $output = "<pre>".$output."</pre>";
    return $output;
}

