<?php
	include('../includes/connection.php');

	$task = $_GET['query'];

	if ($task == 'LOG') {

		$strCheckActivityLog = "
			SELECT 
				* 
			FROM 
				tbl_activity_log 
			WHERE
				fld_date 
			BETWEEN
				'".$_POST['dateFrom']."'
			AND 
				'".$_POST['dateTo']."'
		";
		
		$cmdCheckActivityLog = $conn->query($strCheckActivityLog);
		$rows = $cmdCheckActivityLog->rowCount();

		if ($rows>0) {
			echo true;
		}else{
			echo false;
		}

		$task = "";

	}elseif ($task == 'IWP') {
		
		$strChecIWPReport = "
			SELECT 
				* 
			FROM 
				tbl_iwp_report
			WHERE
				fld_date_released
			BETWEEN
				'".$_POST['dateFrom']."'
			AND 
				'".$_POST['dateTo']."'
		";
		
		$cmdCheckIWPReport = $conn->query($strChecIWPReport);
		$rows = $cmdCheckIWPReport->rowCount();

		if ($rows>0) {
			echo true;
		}else{
			echo false;
		}

		$task = "";

	}elseif ($task == "UPLOAD") {
		
		$target_dir = "../includes/img/applicant-images/";
		$target_file = $target_dir . basename($_FILES["inputImage"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		$strUpdateImage = $conn->prepare("
			UPDATE
				tbl_applicant_information
			SET
				fld_applicant_image = '".$_FILES['inputImage']["name"]."'
			WHERE
				fld_applicant_id = '".$_POST['txtHiddenApplicantIdImage']."'	
		");

	    move_uploaded_file($_FILES["inputImage"]["tmp_name"], $target_file);

	    echo ($strUpdateImage->execute());

	    $task = "";

	}elseif ($task == 'ID') {
		
		$strChecIWPReport = "
			SELECT 
				* 
			FROM 
				tbl_id_report
			WHERE
				fld_date_released
			BETWEEN
				'".$_POST['dateFrom']."'
			AND 
				'".$_POST['dateTo']."'
		";
		
		$cmdCheckIWPReport = $conn->query($strChecIWPReport);
		$rows = $cmdCheckIWPReport->rowCount();

		if ($rows>0) {
			echo true;
		}else{
			echo false;
		}

		$task = "";

	}elseif ($task == 'COLL') {
		
		$strChecColReport = "
			SELECT 
				* 
			FROM 
				tbl_fees_collection
			WHERE
				fld_date_of_payment
			BETWEEN
				'".$_POST['dateFrom']."'
			AND 
				'".$_POST['dateTo']."'
		";
		
		$cmdCheckColReport = $conn->query($strChecColReport);
		$rows = $cmdCheckColReport->rowCount();

		if ($rows>0) {
			echo true;
		}else{
			echo false;
		}

		$task = "";

	}elseif ($task == 'COLLMTO') {
		
		$strChecColReport = "
			SELECT 
				* 
			FROM 
				tbl_fees_collection
			WHERE
				fld_date_of_payment
			BETWEEN
				'".$_POST['collectiondatefrom']."'
			AND 
				'".$_POST['collectiondateto']."'
		";
		
		$cmdCheckColReport = $conn->query($strChecColReport);
		$rows = $cmdCheckColReport->rowCount();

		if ($rows>0) {
			echo true;
		}else{
			echo false;
		}

		$task = "";

	}
?>