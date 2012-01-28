<?php
	$MAIN_SITE="cfgviewer"; # figure out a way to do this better.
	$DIR_OFFSET=(preg_match("/include$/", getcwd())) ? "../" : ""; # especially this
	$ENGINE_PATH="include/cfg_engine.php";
	include($DIR_OFFSET."cfg/functions.php");
	#function db_connect($type, $host, $username, $password, $dbname)
	$localdb=db_connect("local", "", "", "", $MAIN_SITE);

	$action=$_GET['action'];
	
	/* ******************************
			ACTION HANDLING
	***************************** */
	
	switch($action) {
		case "addcfg":
		case "editcfg": # fall through!
			$keyA	=	vV($_POST['keyA']) ? "'".addslashes($_POST['keyA'])	."'" : "NULL";
			$keyB	=	vV($_POST['keyB']) ? "'".addslashes($_POST['keyB'])	."'" : "NULL";
			$keyC	=	vV($_POST['keyC']) ? "'".addslashes($_POST['keyC'])	."'" : "NULL";
			$valueA	=	vV($_POST['valueA']	) ? "'".addslashes($_POST['valueA'])."'" : "NULL";
			$valueB	=	vV($_POST['valueB']	) ? "'".addslashes($_POST['valueB'])."'" : "NULL";
			$valueC	=	vV($_POST['valueC']	) ? "'".addslashes($_POST['valueC'])."'" : "NULL";
			$dtA = (vV($_POST['dtAdate']) && vV($_POST['dtAtime'])) ? "'".$_POST['dtAdate']." ".$_POST['dtAtime']."'" : "NULL";
			$dtB = (vV($_POST['dtBdate']) && vV($_POST['dtBtime'])) ? "'".$_POST['dtBdate']." ".$_POST['dtBtime']."'" : "NULL";
			$dtC = (vV($_POST['dtCdate']) && vV($_POST['dtCtime'])) ? "'".$_POST['dtCdate']." ".$_POST['dtCtime']."'" : "NULL";
			$locked=$_POST['locked'];
			
			if (vV($_GET['id'])) {
				$sql="UPDATE cfg SET keyA=$keyA, keyB=$keyB, keyC=$keyC, valueA=$valueA, valueB=$valueB, valueC=$valueC, datetimeA=$dtA,
					datetimeB=$dtB, datetimeC=$dtC, locked=$locked WHERE id=".$_GET['id'].";";
			} else { 
				$sql="INSERT INTO cfg VALUES (NULL, $keyA, $keyB, $keyC, $valueA, $valueB, $valueC, $dtA, $dtB, $dtC, $locked );";
			}
			$result=mysql_query($sql, $localdb);
			if (!$result) { logProb("ERROR INSERTING/UPDATING CFG [".$sql."]\n".mysql_error()); $notice="?notice=error"; }
			else { $notice="?notice=success"; }
			header("Location: ../cfgviewer.php".$notice."");
		break;
		case "getcfg":
			$id=$_POST['cfgid'];
			$sql="SELECT * FROM cfg WHERE id=".$id.";";
			$result=mysql_query($sql, $localdb);
			if (!$result) logProb($sql."\n\r".mysql_error());
			while ($row=mysql_fetch_array($result)) {				
				$keyA	=vV($row['keyA']) ? $row['keyA'] : "";
				$keyB	=vV($row['keyB']) ? $row['keyB'] : "";
				$keyC	=vV($row['keyC']) ? $row['keyC'] : "";
				$valueA	=vV($row['valueA']) ? $row['valueA'] : "";
				$valueB	=vV($row['valueB']) ? $row['valueB'] : "";
				$valueC	=vV($row['valueC']) ? $row['valueC'] : "";
				$dtAdate=vV($row['datetimeA']) ? substr($row['datetimeA'],0,10) : "";
				$dtAtime=vV($row['datetimeA']) ? substr($row['datetimeA'],11) : "";
				$dtBdate=vV($row['datetimeB']) ? substr($row['datetimeB'],0,10) : "";
				$dtBtime=vV($row['datetimeB']) ? substr($row['datetimeB'],11) : "";
				$dtCdate=vV($row['datetimeC']) ? substr($row['datetimeC'],0,10) : "";
				$dtCtime=vV($row['datetimeC']) ? substr($row['datetimeC'],11) : "";
							
				$response[0]=array("keyA"=>$keyA, "keyB"=>$keyB, "keyC"=>$keyC, "valueA"=>$valueA, "valueB"=>$valueB, "valueC"=>$valueC, 
					"dtAdate"=>$dtAdate, "dtAtime"=>$dtAtime, "dtAdate"=>$dtAdate, "dtBtime"=>$dtBtime, "dtBdate"=>$dtBdate, "dtCtime"=>$dtCtime, "locked"=>$row['locked']);
			}
			echo json_encode($response);
	}
	
	/* ******************************
			HTML DRAWING
	***************************** */	
	
	function drawCfgDialog() { 
		?>
			<div class="dialog span-16 box" id="cfg_dialog">
			<img id="cfg_dialog_close" src="img/delete_icon&16.png" width="12"/>
			<fieldset><legend>Add a configuration</legend>
				<form id="cfg_form" method="POST" action="include/cfg_engine.php?action=addcfg">
					<div class="span-5">
						<p>
							<label>keyA*</label><br/>
							<input autocomplete="off" type="text" class="mandatory" name="keyA" maxlength="64" tabindex="1"/><br/>
							<label>valueA*</label><br/>
							<input autocomplete="off" type="text" class="mandatory" name="valueA" maxlength="256" tabindex="4"/><br/>
							<label>dtA (date + time)</label><br/>
							<input autocomplete="off" class="dtdate" type="text" id="dtA" name="dtAdate" maxlength="10" tabindex="7"/>
							<input autocomplete="off" class="dttime" type="text" name="dtAtime" maxlength="8" tabindex="8"/><br/>
							
							<label>Lock</label><br/>
							<input type="radio" value="0" checked name="locked" tabindex="13"> Unlocked<br/>
							<input type="radio" value="1" name="locked" tabindex="14"> Locked<br/>
						</p>
					</div>				
					<div class="span-5">
						<p>
							<label>keyB</label><br/>
							<input autocomplete="off" type="text" name="keyB" maxlength="64" tabindex="2"/><br/>
							<label>valueB</label><br/>
							<input autocomplete="off" type="text" name="valueB" maxlength="256" tabindex="5"/><br/>
							<label>dtB (date + time)</label><br/>
							<input autocomplete="off" class="dtdate" type="text" id="dtB" name="dtBdate" maxlength="10" tabindex="9"/>
							<input autocomplete="off" class="dttime" type="text" name="dtBtime" maxlength="8" tabindex="10"/><br/>
						</p>
					</div>											
					<div class="span-5 last">
						<p>
							<label>keyC</label><br/>
							<input autocomplete="off" type="text" name="keyC" maxlength="64" tabindex="3"/><br/>
							<label>valueC</label><br/>
							<input autocomplete="off" type="text" name="valueC" maxlength="256" tabindex="6"/><br/>
							<label>dtC (date + time)</label><br/>
							<input autocomplete="off" class="dtdate" type="text" id="dtC" name="dtCdate" maxlength="10" tabindex="11"/>
							<input autocomplete="off" class="dttime" type="text" name="dtCtime" maxlength="8" tabindex="12"/><br/>
						</p>
					</div>	
					<div class="span-15">
						<input type="submit" value="Add" tabindex="15" />
						<button id="cfg_dialog_reset" type="reset" tabindex="16">Reset</button>
					</div>
				</form>
			</fieldset>
			</div> 
	<?php
	}
?>