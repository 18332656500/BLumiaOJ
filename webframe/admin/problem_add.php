<?php session_start(); $ON_ADMIN_PAGE="Yap"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('../include/admin_head.inc.php'); ?>
		<title>Add Problem</title>
	</head>	
	
<?php
	//Vars
	require_once('../include/setting_oj.inc.php');
	//Prepares
	$page_helper = "Maybe you need some help?";
	$PROB_TITLE = "";
	$PROB_TIME = "";
	$PROB_MEMORY = "";
	$PROB_DESC = "Problem Description Placed at here, we recommended that please do <b>not</b> use PRE label since it was did by OJ's problem display system.";
	$PROB_INPUT = "Input Description Placed at here, we recommended that please do <b>not</b> use PRE label since it was did by OJ's problem display system.";
	$PROB_OUTPUT = "Output Description Placed at here, we recommended that please do <b>not</b> use PRE label since it was did by OJ's problem display system.";
	$PROB_SAMP_IN = "";
	$PROB_SAMP_OUT = "";
	$PROB_TEST_IN = "";
	$PROB_TEST_OUT = "";
	//Page Includes
	require("./pages/problem_add.php");
?>
	
</html>