<?php
	include("include/cfg_engine.php");
	
	$sql="SELECT * FROM cfg ORDER BY keyA, keyB, keyC;";
	$result=mysql_query($sql,$localdb);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $MAIN_SITE; ?> - cfgviewer 0.1</title>
	<!-- Import Blueprint resets and grid CSS -->
	<link href="css/blueprint/screen.css" rel="stylesheet" type="text/css" media="screen, projection">
	<link href="css/blueprint/print.css"  rel="stylesheet" type="text/css" media="print" />
	<!-- Import jQuery Smoothness UI (mostly black and white) and site CSS-->
	<link href="css/jquery-ui-1.8.17.custom.css" rel="stylesheet" type="text/css" />
	<link href="css/tablesorter.css" rel="stylesheet" type="text/css" />
	<link href="css/cfgviewer.css" rel="stylesheet" type="text/css" />
	<!-- Import jQuery and site JS -->
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript" src="js/cfgviewer.js"></script>
</head>
<body>

<!-- TODO:
	1) TABINDEX on FORM - OK
	2) FILTERS
	3) DATETIME PICKERS - OK
	4) DELETE 
 -->
<?php drawCfgDialog(); ?>

	<div class="container">
		<h2><a href="index.php"><?php echo $MAIN_SITE; ?></a> <a href="cfgviewer.php">Configuration Viewer</a></h2>
		
		<?php if (vV($_GET['notice'])) { 
				switch ($_GET['notice']) {
					case "success": ?><div id="noticebar" class="success">Action successful.</div><?php break;
					case "error": ?><div id="noticebar" class="error">Action failed.</div><?php break;
				}
			} ?>
		
		<div class="span-8">
			<h3><a id="cfg_dialog_addlink">Add a Configuration...</a></h3>
		</div>
		
		<div class="span-24">
			<table	class="tablesorter" id="cfg_table" summary="Showing configurations..."  border="0" cellspacing="0" cellpadding="0">
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
				<?php if (mysql_num_rows($result)>0) { ?>
				<tbody>	
				<?php while ($row=mysql_fetch_array($result)) { ?>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['keyA']; ?></td>
					<td><?php echo $row['keyB']; ?></td>
					<td><?php echo $row['keyC']; ?></td>
					<td><?php echo $row['valueA']; ?></td>
					<td><?php echo $row['valueB']; ?></td>
					<td><?php echo $row['valueC']; ?></td>
					<td><?php echo $row['datetimeA']; ?></td>
					<td><?php echo $row['datetimeB']; ?></td>
					<td><?php echo $row['datetimeC']; ?></td>
					<td><?php if ($row['locked']) { echo "<img src='img/padlock_closed_icon&16.png'/>"; 
						} else { echo "<img src='img/padlock_open_icon&16.png'/>"; } ?>
					</td>
				</tr>
				<?php } ?>
				</tbody>
				<?php } ?>
			</table>
		</div>
	</div>
</body>
</html>