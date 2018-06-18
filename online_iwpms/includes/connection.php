<?php
	$ip = gethostbyname(getHostName());

	require 'database.php';

	$conn = new PDO ($dbDriver.":host=".$dbHost.";dbname=".$dbName.";charset=".$dbCharset,$dbUsername,$dbPassword);

	date_default_timezone_set("Asia/Manila");

	$serverdir = "http://".$ip."/iwpms";

	function fnInsertLog($activity, $db){
		$conn 		 = $db;
		$user 		 = $_SESSION['username'];
		$date	  	 = date('Y-m-d');
		$time 	  	 = date('h:i:s a');
		$done 	  	 = $activity;
		$strLoginLog = $conn->query("INSERT INTO tbl_activity_log (fld_activity_user,fld_activity,fld_date,fld_time) VALUES ('".$user."','".$done."','".$date."','".$time."')");
	}
?>