<?php
	session_start();
	include("../includes/connection.php");

	$task = $_GET['query'];

	if ($task == "TABLE") {

		$strGetListOfSignatory = "
			SELECT
				tbl_signatories.fld_signatory_id,
				tbl_signatories.fld_signatory_fname,
				tbl_signatories.fld_signatory_mname,
				tbl_signatories.fld_signatory_lname,
				tbl_signatories.fld_signatory_position,
				tbl_signatories.fld_signatory_office,
				tbl_signatories.fld_signatory_status
			FROM
				tbl_signatories
		";

		$cmdGetListOfSignatory = $conn->query($strGetListOfSignatory);
		$arrayGetListofSignatory = [];

		while ($data=$cmdGetListOfSignatory->fetch(PDO::FETCH_BOTH)) {
			
			$signatory_id 		= $data[0];
			$signatory_fullname = $data[1].' '.$data[2].' '.$data[3];
			$signatory_position = $data[4];
			$signatory_office 	= $data[5];
			$signatory_status	= $data[6];

			$rows = [
				'signatory_id'		 => $signatory_id,
				'signatory_fullname' => $signatory_fullname,
				'signatory_position' => $signatory_position,
				'signatory_office'	 => $signatory_office,
				'signatory_status'	 => $signatory_status,
 			];

			array_push($arrayGetListofSignatory, $rows);
		}
		echo json_encode($arrayGetListofSignatory);

		$task = "";

	}elseif ($task == "ADD") {

		$strDupCheckSignatory = "
			SELECT
				*
			FROM
				tbl_signatories
			WHERE
				fld_signatory_fname = '".$_POST['sfname']."'
			AND
				fld_signatory_mname = '".$_POST['smname']."'
			AND
				fld_signatory_lname = '".$_POST['slname']."'

		";

		$cmdDupCheckSignatory = $conn->query($strDupCheckSignatory);
		$rowCount = $cmdDupCheckSignatory->rowCount();

		if($rowCount>=1){

			echo "EXIST";

		}else{

			$strAddSignatory = $conn->prepare("
				INSERT INTO
					tbl_signatories (fld_signatory_fname,fld_signatory_mname,fld_signatory_lname,fld_signatory_position,fld_signatory_office,fld_signatory_status)
				VALUES (
				'".$_POST['sfname']."',
				'".$_POST['smname']."',
				'".$_POST['slname']."',
				'".$_POST['sposition']."',
				'".$_POST['signatoryoffice']."',
				'1'
				)
			");

			fnInsertLog('ADDED NEW SIGNATORY = '.$_SESSION["username"], $conn);
			echo ($strAddSignatory->execute());
		}

		$task = "";

	}elseif ($task == "VIEW"){

		$strViewSignatory = "
			SELECT
				tbl_signatories.fld_signatory_id,
				tbl_signatories.fld_signatory_fname,
				tbl_signatories.fld_signatory_mname,
				tbl_signatories.fld_signatory_lname,
				tbl_signatories.fld_signatory_position,
				tbl_signatories.fld_signatory_office,
				tbl_signatories.fld_signatory_status
			FROM
				tbl_signatories
			WHERE
				tbl_signatories.fld_signatory_id = '".$_POST['signatory_id']."'
		";

		$cmdViewSignatory = $conn->query($strViewSignatory);
		$arrayViewSignatory = [];

		while ($data=$cmdViewSignatory->fetch(PDO::FETCH_BOTH)) {
			
			$signatory_id 		= $data[0];
			$signatory_fname 	= $data[1];
			$signatory_mname 	= $data[2];
			$signatory_lname 	= $data[3];
			$signatory_fullname = $data[1].' '.$data[2].' '.$data[3];
			$signatory_position = $data[4];
			$signatory_office 	= $data[5];
			$signatory_status	= $data[6];

			$rows = [
				'signatory_id'		 => $signatory_id,
				'signatory_fname'	 => $signatory_fname,
				'signatory_mname'	 => $signatory_mname,
				'signatory_lname'	 => $signatory_lname,
				'signatory_fullname' => $signatory_fullname,
				'signatory_position' => $signatory_position,
				'signatory_office'	 => $signatory_office,
				'signatory_status'	 => $signatory_status
 			];

			array_push($arrayViewSignatory, $rows);
		}
		echo json_encode($arrayViewSignatory);

		$task = "";

	}elseif ($task == "EDIT"){

		$strEditSignatory = $conn->prepare("
			UPDATE
				tbl_signatories
			SET
				fld_signatory_fname 	= '".$_POST['esfname']."',
				fld_signatory_mname 	= '".$_POST['esmname']."',
				fld_signatory_lname 	= '".$_POST['eslname']."',
				fld_signatory_office 	= '".$_POST['esignatoryoffice']."',
				fld_signatory_position 	= '".$_POST['esposition']."'
			WHERE
				fld_signatory_id = '".$_POST['hiddenSignatoryId']."'
		");
		
		echo ($strEditSignatory->execute());

		$task = "";

	}elseif ($task == "DEAC") {
		
		$strDeactivateSignatory = $conn->prepare("
			UPDATE
				tbl_signatories
			SET
				fld_signatory_status = '0'
			WHERE
				fld_signatory_id = '".$_POST['signatory_id']."'

		");

		fnInsertLog('DEACTIVATED SIGNATORY = '.$_SESSION['username'], $conn);

		echo ($strDeactivateSignatory->execute());

		$task == "";

	}elseif ($task == "ACTI") {
		
		$strActivateSignatory = $conn->prepare("
			UPDATE
				tbl_signatories
			SET
				fld_signatory_status = '1'
			WHERE
				fld_signatory_id = '".$_POST['signatory_id']."'

		");

		fnInsertLog('ACTIVATED SIGNATORY = '.$_SESSION['username'], $conn);

		echo ($strActivateSignatory->execute());

		$task == "";

	}

?>