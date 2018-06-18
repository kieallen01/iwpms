<?php
	include("../includes/connection.php");

	$task = $_GET["query"];

	if ($task == "TABLE") {
		
		$strGetAllApplicant = "
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
			WHERE
				tbl_applicant_requirement.fld_requirement_status = '0'
			AND
				tbl_applicant_requirement.fld_requirement1 = '1'
			AND
				tbl_applicant_requirement.fld_requirement2 = '0'
			AND
				tbl_applicant_requirement.fld_approval = '1'
		";

		$cmdGetAllApplicant = $conn->query($strGetAllApplicant);
		$arrayGetAllApplicant = [];

		while ($data=$cmdGetAllApplicant->fetch(PDO::FETCH_BOTH)) {	
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
			array_push($arrayGetAllApplicant, $rows);
		}
		echo json_encode($arrayGetAllApplicant);

		$task = "";

	}elseif ($task == "COMPLETE") {

		$strGetAllApplicantC = "
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
			WHERE
				tbl_applicant_requirement.fld_requirement1 = '1'
			AND
				tbl_applicant_requirement.fld_requirement2 = '1'
			AND
				tbl_applicant_requirement.fld_approval = '1'
		";

		$cmdGetAllApplicantC = $conn->query($strGetAllApplicantC);
		$arrayGetAllApplicantC = [];

		while ($data=$cmdGetAllApplicantC->fetch(PDO::FETCH_BOTH)) {	
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
			array_push($arrayGetAllApplicantC, $rows);
		}
		echo json_encode($arrayGetAllApplicantC);

		$task = "";
		
	}else if ($task == "UPDATES") {

		for($i = 0; $i < count($_POST["tocollect"]); $i++){
			$strAddFee = $conn->query("
				INSERT INTO
					tbl_fees_collection
				VALUES(
					'".$_POST['ornumber']."',
					'".$_POST['tocollect'][$i]['feeid']."',
					'".$_POST['tocollect'][$i]['feedesc']."',
					'".$_POST['tocollect'][$i]['feecost']."',
					'".$_POST['paymentdate']."',
					'".$_POST['applicantid']."',
					'".$_POST['total']."',
					'".$_POST['penaltyfee']."'
				)
			");
		}

		$strUpdateRequirements = $conn->query("
			UPDATE
				tbl_applicant_requirement
			SET
				fld_requirement1 = '1',
				fld_requirement2 = '1'
			WHERE
				tbl_applicant_requirement.fld_applicant_id = '".$_POST['applicantid']."'
		");

		echo true;

		$task = "";

	}elseif ($task == "VIEW") {

		$arrayApplicantInfo = [];

		$strGetPOB = "
			SELECT
				tbl_applicant_information.fld_applicant_id,
				tbl_applicant_information.fld_pob_prov,
				tbl_applicant_information.fld_pob_citymun,
				tbl_applicant_information.fld_pob_bar,

				tbl_address_province.fld_address_province_desc,
				tbl_address_citymun.fld_address_citymun_desc,
				tbl_address_brgy.fld_address_brgy_desc
			FROM
				tbl_applicant_information
			INNER JOIN
				tbl_address_province ON tbl_applicant_information.fld_pob_prov = tbl_address_province.fld_address_province_code
			INNER JOIN
				tbl_address_citymun ON tbl_applicant_information.fld_pob_citymun = tbl_address_citymun.fld_address_citymun_code
			INNER JOIN 
				tbl_address_brgy ON tbl_applicant_information.fld_pob_bar = tbl_address_brgy.fld_address_brgy_code
			WHERE
				tbl_applicant_information.fld_applicant_id = '".$_POST['applicantid']."'
		";

		$cmdGetPOB = $conn->query($strGetPOB);
		while ($data=$cmdGetPOB->fetch(PDO::FETCH_BOTH)) {

			$applicantid 	= $data[0];
			$provcodepob	= $data[1];
			$citymuncodepob	= $data[2];
			$brgycodepob	= $data[3];
			$provdescpob	= $data[4];
			$citymundescpob	= $data[5];
			$brgydescpob	= $data[6];
			$pobaddress 	= $data[6].', '.$data[5].' '.$data[4];

			$rows = [
				'applicantid' 	 => $applicantid,
				'provcodepob' 	 => $provcodepob,
				'citymuncodepob' => $citymuncodepob,
				'brgycodepob' 	 => $brgycodepob,
				'provdescpob' 	 => $provdescpob,
				'citymundescpob' => $citymundescpob,
				'brgydescpob' 	 => $brgydescpob,
				'pobaddress'  	 => $pobaddress
			];
			array_push($arrayApplicantInfo, $rows);
		}

		$strGetApplicantInfo = "
			SELECT
				tbl_applicant_information.fld_applicant_id,
				tbl_applicant_information.fld_applicant_fname,
				tbl_applicant_information.fld_applicant_mname,
				tbl_applicant_information.fld_applicant_lname,
				tbl_applicant_information.fld_applicant_gender,
				tbl_applicant_information.fld_applicant_dob,
				tbl_applicant_information.fld_phone,
				
				tbl_address_province.fld_address_province_desc,
				tbl_address_citymun.fld_address_citymun_desc,
				tbl_address_brgy.fld_address_brgy_desc,

				tbl_applicant_information.fld_position,
				tbl_applicant_information.fld_cb_add,
				tbl_applicant_information.fld_cb_name,
				tbl_applicant_information.fld_emp_name,

				tbl_applicant_information.fld_add_prov,
				tbl_applicant_information.fld_add_citymun,
				tbl_applicant_information.fld_add_bar
			FROM
				tbl_applicant_information
			INNER JOIN
				tbl_address_province ON tbl_applicant_information.fld_add_prov = tbl_address_province.fld_address_province_code
			INNER JOIN
				tbl_address_citymun ON tbl_applicant_information.fld_add_citymun = tbl_address_citymun.fld_address_citymun_code
			INNER JOIN 
				tbl_address_brgy ON tbl_applicant_information.fld_add_bar = tbl_address_brgy.fld_address_brgy_code
			WHERE
				tbl_applicant_information.fld_applicant_id = '".$_POST['applicantid']."'
		";
		$cmdGetApplicantInfo = $conn->query($strGetApplicantInfo);

		while ($data=$cmdGetApplicantInfo->fetch(PDO::FETCH_BOTH)) {
			$applicantid 	= $data[0];
			$fname 		 	= $data[1];
			$mname 		 	= $data[2];
			$lname 		 	= $data[3];
			$gender 	 	= $data[4];
			$dob 	 	 	= $data[5];
			$phone 	 	 	= $data[6];
			$homeaddress 	= $data[9].', '.$data[8].' '.$data[7];

			$provdescha	 	= $data[7];
			$citymundescha	= $data[8];
			$brgydescha	 	= $data[9];

			$position 	 	= $data[10];
			$cbaddress   	= $data[11];
			$cbname 	 	= $data[12];
			$empname 	 	= $data[13];

			$provcodeha	 	= $data[14];
			$citymuncodeha	= $data[15];
			$brgycodeha	 	= $data[16];

			$rows = [
				'applicantid'	=> $applicantid,
				'fname'		 	=> $fname,
				'mname'		 	=> $mname,
				'lname'		 	=> $lname,
				'gender'	 	=> $gender,
				'dob'	 	 	=> $dob,
				'phone'	 	 	=> $phone,
				'homeaddress'	=> $homeaddress,
				'provdescha' 	=> $provdescha,
				'citymundescha' => $citymundescha,
				'brgydescha' 	=> $brgydescha,
				'position'	 	=> $position,
				'cbaddress'	 	=> $cbaddress,
				'cbname' 	 	=> $cbname,
				'empname' 	 	=> $empname,
				'provcodeha' 	=> $provcodeha,
				'citymuncodeha' => $citymuncodeha,
				'brgycodeha' 	=> $brgycodeha
			];
			array_push($arrayApplicantInfo, $rows);
		}
		echo json_encode($arrayApplicantInfo);

		$task = "";

	}

?>