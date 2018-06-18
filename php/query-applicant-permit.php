<?php
	include("../includes/connection.php");

	$task = $_GET["query"];

	if ($task == "TABLE") {
		
		$strGetPermitApplicant = "
			SELECT
				tbl_applicant_information.fld_applicant_id,
				tbl_applicant_information.fld_applicant_fname,
				tbl_applicant_information.fld_applicant_mname,
				tbl_applicant_information.fld_applicant_lname,
				tbl_applicant_information.fld_applicant_gender,

				tbl_applicant_information.fld_add_prov,
				tbl_applicant_information.fld_add_citymun,
				tbl_applicant_information.fld_add_bar,

				tbl_address_province.fld_address_province_desc,	
				tbl_address_citymun.fld_address_citymun_desc,
				tbl_address_brgy.fld_address_brgy_desc,

				tbl_applicant_information.fld_position
			FROM
				tbl_applicant_information
			INNER JOIN
				tbl_address_province ON tbl_applicant_information.fld_add_prov = tbl_address_province.fld_address_province_code
			INNER JOIN
				tbl_address_citymun ON tbl_applicant_information.fld_add_citymun = tbl_address_citymun.fld_address_citymun_code
			INNER JOIN 
				tbl_address_brgy ON tbl_applicant_information.fld_add_bar = tbl_address_brgy.fld_address_brgy_code
			INNER JOIN
				tbl_applicant_requirement ON tbl_applicant_information.fld_applicant_id = tbl_applicant_requirement.fld_applicant_id
			INNER JOIN
				tbl_application_details ON tbl_applicant_information.fld_applicant_id = tbl_application_details.fld_applicant_id
			WHERE
				tbl_applicant_requirement.fld_requirement_status = '1'
			AND 
				tbl_application_details.fld_released_year  >= '".date('Y')."'
		";

		$cmdGetPermitApplicant = $conn->query($strGetPermitApplicant);
		$arrayGetPermitApplicant = [];

		while ($data=$cmdGetPermitApplicant->fetch(PDO::FETCH_BOTH)) {	
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
			array_push($arrayGetPermitApplicant, $rows);
		}
		echo json_encode($arrayGetPermitApplicant);

		$task = "";
	}

?>