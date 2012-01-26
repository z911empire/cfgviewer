<?php
	include("include/engine.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $MAIN_SITE; ?></title>
	<!-- Import Blueprint resets and grid CSS -->
	<link rel="stylesheet" href="css/blueprint/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="css/blueprint/print.css" type="text/css" media="print">
	<!-- Import jQuery Smoothness UI (mostly black and white) and site CSS-->
	<link href="css/jquery-ui-1.8.17.custom.css" rel="stylesheet" type="text/css" />
	<link href="css/main.css" rel="stylesheet" type="text/css" />
	<!-- Import jQuery and site JS -->
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body>

<!-- TODO:
	1) TABINDEX on FORM
	2) FILTERS
	3) DATETIME PICKERS - OK
 -->

	<div class="dialog span-16 box">
		<fieldset><legend>Add a configuration</legend>
			<form method="POST" action="<?php echo $ENGINE_PATH."?action=addcfg"; ?>">
				<div class="span-5">
					<p>
						<label>keyA</label><br/>
						<input type="text" class="mandatory" name="keyA" maxlength="64"/><br/>
						<label>valueA</label><br/>
						<input type="text" class="mandatory" name="valueA" maxlength="256"/><br/>
						<label>dtA (date + time)</label><br/>
						<input class="dtdate" type="text" id="dtA" name="dtAdate" maxlength="10"/>
						<input class="dttime" type="text" name="dtAtime" maxlength="8"/><br/>
						
						<label>Lock</label><br/>
						<input type="radio" value="0" checked name="locked"> Unlocked<br/>
						<input type="radio" value="1" name="locked"> Locked<br/>
					</p>
				</div>				
				<div class="span-5">
					<p>
						<label>keyB</label><br/>
						<input type="text" name="keyB" maxlength="64"/><br/>
						<label>valueB</label><br/>
						<input type="text" name="valueB" maxlength="256"/><br/>
						<label>dtB (date + time)</label><br/>
						<input class="dtdate" type="text" id="dtB" name="dtBdate" maxlength="10"/>
						<input class="dttime" type="text" name="dtBtime" maxlength="8"/><br/>
					</p>
				</div>											
				<div class="span-5 last">
					<p>
						<label>keyC</label><br/>
						<input type="text" name="keyC" maxlength="64"/><br/>
						<label>valueC</label><br/>
						<input type="text" name="valueC" maxlength="256"/><br/>
						<label>dtC (date + time)</label><br/>
						<input class="dtdate" type="text" id="dtC" name="dtCdate" maxlength="10"/>
						<input class="dttime" type="text" name="dtCtime" maxlength="8"/><br/>
					</p>
				</div>	
				
				<div class="span-15">
					<input type="submit" value="Add" />				
				</div>
			</form>
		</fieldset>
	</div>

	<div class="container">
		<h2>Configuration Viewer Prototype</h2>
		
		<?php if (vV($_GET['notice'])) { 
				switch ($_GET['notice']) {
					case "success": ?>
						<div class="success">Action successful.</div>
					<?php break;
					case "error": ?>
						<div class="error">Action failed.</div>
					<?php break;
				}
			} ?>
		
		<div class="span-8">
			<h3><a id="addcfg">Add a Configuration...</a></h3>
		</div>
		
		<div class="span-24">
			<table summary="Showing configurations..."  border="0" cellspacing="0" cellpadding="0">
				<thead><tr>
					<th class="span-1">id</th>
					<th class="span-2">keyA</th>
					<th class="span-2">keyB</th>
					<th class="span-2">keyC</th>
					<th class="span-3">valueA</th>
					<th class="span-3">valueB</th>
					<th class="span-3">valueC</th>
					<th class="span-2">dtA</th>
					<th class="span-2">dtB</th>
					<th class="span-2">dtC</th>
					<th class="span-2 last">lock</th>
				</tr></thead>
				
			</table>
		</div>
	</div>
</body>
</html>