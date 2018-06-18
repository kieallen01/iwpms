<?php
	session_start();
	include('../includes/connection.php');

	$task = $_GET["query"];

	if ($task == "TABLE") {

		$strGetListOfPenalty = "
			SELECT
				tbl_penalty.fld_penalty_id,
				tbl_penalty.fld_penalty_description,
				tbl_penalty.fld_penalty_rate,
				tbl_penalty.fld_penalty_deadline,
				tbl_penalty.fld_penalty_status
			FROM
				tbl_penalty
		";

		$cmdGetListOfPenalty = $conn->query($strGetListOfPenalty);
		$arrayGetListofPenalty = [];

		while ($data=$cmdGetListOfPenalty->fetch(PDO::FETCH_BOTH)) {
			
			$penalty_id 		= $data[0];
			$penalty_desc   	= $data[1];
			$penalty_rate   	= $data[2];
			$penalty_deadline 	= $data[3];
			$penalty_status	 	= $data[4];

			$rows = [
				'penalty_id'		=> $penalty_id,
				'penalty_desc'		=> $penalty_desc,
				'penalty_rate'		=> $penalty_rate,
				'penalty_deadline' 	=> $penalty_deadline,
				'penalty_status' 	=> $penalty_status
			];

			array_push($arrayGetListofPenalty, $rows);
		}
		echo json_encode($arrayGetListofPenalty);

		$task = "";
	}elseif ($task == "ADD"){

		$penaltydescription = $_POST['penaltydescription'];
		$penaltyrate 		= $_POST['penaltyrate'];
		$penaltydeadline 	= $_POST['penaltydeadline'];

		$strAddPenalty = $conn->prepare("
			INSERT INTO
				tbl_penalty (fld_penalty_description,fld_penalty_rate,fld_penalty_deadline,fld_penalty_status)
			VALUES (
			'".$penaltydescription."',
			'".$penaltyrate."',
			'".$penaltydeadline."',
			'0'
			);
		");

		fnInsertLog('ADDED NEW PENALTY = '.$penaltydescription, $conn);
		echo ($strAddPenalty->execute());

		$task = "";

	}elseif($task == "VIEW"){

		$strViewPenalty = "
			SELECT
				tbl_penalty.fld_penalty_id,
				tbl_penalty.fld_penalty_description,
				tbl_penalty.fld_penalty_rate,
				tbl_penalty.fld_penalty_deadline,
				tbl_penalty.fld_penalty_status
			FROM
				tbl_penalty
			WHERE
				tbl_penalty.fld_penalty_id = '".$_POST['penalty_id']."'
		";

		$cmdViewPenalty = $conn->query($strViewPenalty);
		$arrayViewPenalty = [];

		while ($data=$cmdViewPenalty->fetch(PDO::FETCH_BOTH)) {
			
			$penalty_id 		= $data[0];
			$penalty_desc   	= $data[1];
			$penalty_rate   	= $data[2];
			$penalty_deadline 	= $data[3];
			$penalty_status	 	= $data[4];

			$rows = [
				'penalty_id'		=> $penalty_id,
				'penalty_desc'		=> $penalty_desc,
				'penalty_rate'		=> $penalty_rate,
				'penalty_deadline' 	=> $penalty_deadline,
				'penalty_status' 	=> $penalty_status
			];

			array_push($arrayViewPenalty, $rows);
		}
		echo json_encode($arrayViewPenalty);

		$task = "";

	}elseif ($task == "EDIT") {
		
		$strEditPenalty = $conn->prepare("
			UPDATE
				tbl_penalty
			SET
				fld_penalty_description = '".$_POST['ependescription']."',
				fld_penalty_rate = '".$_POST['epenrate']."',
				fld_penalty_deadline = '".$_POST['ependate']."'
			WHERE
				fld_penalty_id = '".$_POST['hiddenPenaltyId']."'
		");
		
		echo ($strEditPenalty->execute());	

		$task = "";
	}


?>