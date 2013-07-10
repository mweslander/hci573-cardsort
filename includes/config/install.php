<?php

/*
 * This page will install the database and tables
 */

require_once ('../classes/installation.inc.php');

if ($install = new Installation())
{
    echo 'Database installed successfully<br>';
    echo "<a href='../../'>Go to Site</a>";
}