<?php
	$MAIN_SITE="cfgviewer"; # figure out a way to do this better.
	$MAIN_ROOT=$_SERVER['DOCUMENT_ROOT']."/".$MAIN_SITE;
	include($MAIN_ROOT."/cfg/functions.php");
	$localdb=db_connect($MAIN_SITE, "local");

?>