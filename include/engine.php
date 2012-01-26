<?php
	$MAIN_SITE="cfgviewer"; # figure out a way to do this better.
	$DIR_OFFSET=(preg_match("/include$/", getcwd())) ? "../" : ""; # especially this
	$ENGINE_PATH="include/engine.php";
	include($DIR_OFFSET."cfg/functions.php");
	#function db_connect($type, $host, $username, $password, $dbname)
	$localdb=db_connect("local", "", "", "", $MAIN_SITE);

	$action=$_GET['action'];
	
	/* ******************************
			ACTION HANDLING
	***************************** */
	
	switch($action) {
		case "addcfg":
			
			$keyA	=	vV($_POST['keyA']) ? "'".$_POST['keyA']	."'" : "NULL";
			$keyB	=	vV($_POST['keyB']) ? "'".$_POST['keyB']	."'" : "NULL";
			$keyC	=	vV($_POST['keyC']) ? "'".$_POST['keyC']	."'" : "NULL";
			$valueA	=	vV($_POST['valueA']	) ? "'".$_POST['valueA']."'" : "NULL";
			$valueB	=	vV($_POST['valueB']	) ? "'".$_POST['valueB']."'" : "NULL";
			$valueC	=	vV($_POST['valueC']	) ? "'".$_POST['valueC']."'" : "NULL";
			$dtA = (vV($_POST['dtAdate']) && vV($_POST['dtAtime'])) ? "'".$_POST['dtAdate']." ".$_POST['dtAtime']."'" : "NULL";
			$dtB = (vV($_POST['dtBdate']) && vV($_POST['dtBtime'])) ? "'".$_POST['dtBdate']." ".$_POST['dtBtime']."'" : "NULL";
			$dtC = (vV($_POST['dtCdate']) && vV($_POST['dtCtime'])) ? "'".$_POST['dtCdate']." ".$_POST['dtCtime']."'" : "NULL";
			$locked=$_POST['locked'];
			
			$sql="INSERT INTO cfg VALUES (NULL, $keyA, $keyB, $keyC, $valueA, $valueB, $valueC, $dtA, $dtB, $dtC, $locked );";
			$result=mysql_query($sql, $localdb);
			if (!$result) { logProb("ERROR INSERTING CFG [".$sql."]\n".mysql_error()); $notice="?notice=error"; }
			else { $notice="?notice=success"; }
			header("Location: ../index.php".$notice."");
			
		break;
	}
	
?>