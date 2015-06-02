<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<script src="./sitefiles/js/highcharts.js"></script>
		<title>BLumiaOJ</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	$jresult=Array("MSG_PD","MSG_PR","MSG_CI","MSG_RJ","MSG_AC","MSG_PE","MSG_WA","MSG_TLE","MSG_MLE","MSG_OLE","MSG_RE","MSG_CE","MSG_CO","MSG_TR");
	
	//Prepares
	if (isset($_SESSION['user_id']) || isset($_GET['user'])) {
		//User Logged in and wanna see him/herself's info.
		if (!isset($_GET['user']))
			$user_id = $_SESSION['user_id'];
		else
			$user_id = $_GET['user'];
		
		$sql=$pdo->prepare("select * from users where user_id=?");
		$sql->execute(array($user_id));
		$res=$sql->fetch();
		//var_dump($res);
		$sql->closeCursor();
		
		$user_name = $res['nick'];
		$user_school = $res['school'];
		$user_email = $res['email'];
		
	} else {
		//退出
		exit(0);
	}
	
	// count solved
	$sql=$pdo->prepare("SELECT count(DISTINCT problem_id) as `ac` FROM `solution` WHERE `user_id`=? AND `result`=4");
	$sql->execute(array($user_id));
	$res=$sql->fetch();
	$user_solved = $res['ac'];
	$sql->closeCursor();
	
	// count submission
	$sql=$pdo->prepare("SELECT count(solution_id) as `Submit` FROM `solution` WHERE `user_id`=?");
	$sql->execute(array($user_id));
	$res=$sql->fetch();
	$user_submit = $res['Submit'];
	$sql->closeCursor();
	
	// count other
	$sql=$pdo->prepare("SELECT result,count(1) FROM solution WHERE `user_id`=? AND result>=4 group by result order by result");
	$sql->execute(array($user_id));
	$res=$sql->fetchAll();
	$sql->closeCursor();
	//print_r($res);
	$i = 0;
	foreach($res as $row) {
		//print_r($row);
		$user_other[$i++]=$row;
	}
	
	//Page Includes
	require("./pages/userinfo.php");
?>
	
</html>