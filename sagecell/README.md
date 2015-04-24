SageCell
=============

A Moodle filter plug-in to view results of Sage code using the SageMathCell server. 
It embeds any code as plain text.

NOTICE: this software is in no way endorsed by or affiliated with the official SageMath project or team.

 *  This filter will replace Sage code in [sagecell]...[/sagecell] block 
 *  with the result of calculations in embedded sagecell.

Installation
------------
To install (on Moodle 2):

1. Un-compress the Zip/Gzip archive, and copy the folder renamed 'sagecell' to your moodle/filter/ directory.
2. Log in to Moodle as admininstrator, go to Site Administration | Plugins | Filters | Manage Filters.
3. Choose 'On' or 'Off but available' in the drop-down menu next to 'SageCell'.

Usage
-----
The syntax to embed a Sage code:

    [sagecell]any Sage code[/sagecell]

Links
-----
* Moodle plugin entry: <http://moodle.org/plugins/view.php?plugin=filter_sagecell>
* Code, Git: <https://github.com/eugenemodlo/moodle-filter_sagecell>
* Demo : <http://modlo.ccjournals.eu>
* "Why square brackets?", <http://bitbucket.org/nfreear/timelinewidget/src/tip/filter.php#cl-36>

Notes
-----
* Tested in Moodle 2.8.5.
* No database access, JavaScript only
* Filter syntax is case-sensitive.

Notices
-------
SageCell plugin, Copyright © 2015 Eugene Modlo, Sergey Semerikov.

* License: <http://www.gnu.org/copyleft/gpl.html> GNU GPL v3 or later.

SageMathCell, Copyright (c) 2011, Jason Grout, Ira Hanson, Alex Kramer, William Stein

* License: <https://github.com/sagemath/sagecell/blob/master/LICENSE.txt> GNU GPL v2.
