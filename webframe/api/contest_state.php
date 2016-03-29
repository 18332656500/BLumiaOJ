<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/file_functions.php");
    
	if (!isset($_GET['cid'])) {
		echo "Not Got an Contest Id";
		exit(0);
	}
	
	if (!isset($_GET['do'])) {
		echo "No Operation";
		exit(0);
	}
	
	$contest_do		= intval($_GET['do']);
	$contest_id		= intval($_GET['cid']);
	
	/*
	removexss
	if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ( $user_id);
		$password= stripslashes ( $password);
	}*/
	
	/* do check work*/
	$sql=$pdo->prepare("SELECT * FROM `contest` WHERE `contest_id`=?");
	$sql->execute(array($contest_id));
	$affected_rows = $sql->rowCount();
	$it_exist = ($affected_rows == 1) ? true : false;
	
	if($it_exist) {
		
		switch($contest_do) {
			case 1:
				$is_private = 0;
				$contest_defunct = "N";
				break;
			case 2:
				$is_private = 1;
				$contest_defunct = "N";
				break;
			case 3:
				$is_private = 0;
				$contest_defunct = "Y";
				break;
			default:
				$is_private = 0;
				$contest_defunct = "N";
				break;
		}
		
		$sql=$pdo->prepare("UPDATE `contest` set `private`=?,`defunct`=? WHERE `contest_id`=?");
		$sql->execute(array($is_private,$contest_defunct,$contest_id));
		echo "Contest State Modified Successful";
		
	} else {
		echo "Contest NOT Exist!";
		exit(0);
	}
	
	
?>
