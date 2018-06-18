<?php
	include("../includes/connection.php");

	$strGetActivityLog = "
		SELECT
			*
		FROM 
			tbl_activity_log
	";

	$cmdGetActivityLog = $conn->query($strGetActivityLog);
	$arrayGetActivityLog = [];

	while ($data=$cmdGetActivityLog->fetch(PDO::FETCH_BOTH)) {
		$username 	= $data[1];
		$activity 	= $data[2];
		$date 		= $data[3];
		$time 		= $data[4];

		$rows = [
			'username' 	=> $username,
			'activity'	=>$activity,
			'date'		=>$date,
			'time'		=>$time
		];
		array_push($arrayGetActivityLog, $rows);
	}
	echo json_encode($arrayGetActivityLog);
?>