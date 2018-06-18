<?php
	include("../includes/connection.php");

	$task = $_GET["query"];

	if ($task == "TABLE") {
		
		$strGetRenewalApplicant = "
			SELECT
				tbl_applicant_information.fld_applicant_id,
				tbl_applicant_information.fld_applicant_fname,
				tbl_applicant_information.fld_applicant_mname,
				tbl_applicant_information.fld_applicant_lname,
				tbl_applicant_information.fld_applicant_gender,

				tbl_applicant_information.fld_pob_prov,
				tbl_applicant_information.fld_pob_citymun,
				tbl_applicant_information.fld_pob_bar,

				tbl_address_province.fld_address_province_desc,	
				tbl_address_citymun.fld_address_citymun_desc,
				tbl_address_brgy.fld_address_brgy_desc,

				tbl_applicant_information.fld_position
			FROM
				tbl_applicant_information
			INNER JOIN
				tbl_address_province ON tbl_applicant_information.fld_pob_prov = tbl_address_province.fld_address_province_code
			INNER JOIN
				tbl_address_citymun ON tbl_applicant_information.fld_pob_citymun = tbl_address_citymun.fld_address_citymun_code
			INNER JOIN 
				tbl_address_brgy ON tbl_applicant_information.fld_pob_bar = tbl_address_brgy.fld_address_brgy_code
			INNER JOIN
				tbl_application_details ON tbl_applicant_information.fld_applicant_id = tbl_application_details.fld_applicant_id
			WHERE
				tbl_application_details.fld_released_year < '".date('Y')."'
		";

		$cmdGetRenewalApplicant = $conn->query($strGetRenewalApplicant);
		$arrayGetRenewalApplicant = [];

		while ($data=$cmdGetRenewalApplicant->fetch(PDO::FETCH_BOTH)) {	
			$applicantid 	= $data[0];
			$fullname 		= $data[3].', '.$data[1].' '.$data[2];
			$gender 		= $data[4];
			$address 		= $data[10].', '.$data[9].' '.$data[8];
			$position 		= $data[11];

			$rows = [
				'applicantid' => $applicantid,
				'fullname' 	  => $fullname,
				'gender' 	  => $gender,
				'address' 	  => $address,
				'position'    => $position
			];
			array_push($arrayGetRenewalApplicant, $rows);
		}
		echo json_encode($arrayGetRenewalApplicant);

		$task = "";

	}elseif ($task == "APPROVE") {

		$strUpdateRequirement = $conn->prepare("
				UPDATE
					tbl_applicant_requirement
				SET
					fld_requirement1 = 1,
					fld_requirement2 = 0,
					fld_requirement3 = 0,
					fld_requirement4 = 0,
					fld_requirement5 = 0,
					fld_approval = 1,
					fld_requirement_status = 0
				WHERE
					fld_applicant_id = '".$_POST['applicantid']."'
			");
		
		$strUpdateDetails = $conn->prepare("
				UPDATE
					tbl_application_details
				SET
					fld_application = 'Office',
					fld_application_date = '".date('Y-m-d')."',
					fld_released_year = 'N'
				WHERE
					fld_applicant_id = '".$_POST['applicantid']."'

			");

		if ($strUpdateRequirement->execute()) {
			if ($strUpdateDetails->execute()) {
				echo true;
			}else{
				echo false;
			}
		}else{
			echo false;
		}

		$task = "";

	}

?>