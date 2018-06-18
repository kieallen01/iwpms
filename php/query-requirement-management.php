<?php
	include("../includes/connection.php");

	$task = $_GET["query"];

	if ($task == "TABLE") {
		
		$strGetWalkinApplicant = "
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
				tbl_applicant_requirement.fld_approval = '1'
			AND
				tbl_application_details.fld_released_year = 'N'
		";

		$cmdGetWalkinApplicant = $conn->query($strGetWalkinApplicant);
		$arrayGetWalkinApplicant = [];

		while ($data=$cmdGetWalkinApplicant->fetch(PDO::FETCH_BOTH)) {	
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
			array_push($arrayGetWalkinApplicant, $rows);
		}
		echo json_encode($arrayGetWalkinApplicant);

		$task = "";

	}else if($task == 'VIEW'){

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
			$fullname 		= $data[3].', '.$data[1].' '.$data[2];
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
				'fullname'		=> $fullname,
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

		$strGetRequirements = "
			SELECT
				tbl_applicant_requirement.fld_requirement1,
				tbl_applicant_requirement.fld_requirement2,
				tbl_applicant_requirement.fld_requirement3,
				tbl_applicant_requirement.fld_requirement4,
				tbl_applicant_requirement.fld_requirement5
			FROM
				tbl_applicant_requirement
			WHERE
				tbl_applicant_requirement.fld_applicant_id = '".$_POST['applicantid']."'
		";
		$cmdGetRequirements = $conn->query($strGetRequirements);

		while ($data=$cmdGetRequirements->fetch(PDO::FETCH_BOTH)) {
			$req1 = $data[0];
			$req2 = $data[1];
			$req3 = $data[2];
			$req4 = $data[3];
			$req5 = $data[4];

			$rows = [
				'req1' => $req1,
				'req2' => $req2,
				'req3' => $req3,
				'req4' => $req4,
				'req5' => $req5,
			];
			array_push($arrayApplicantInfo, $rows);
		}
		echo json_encode($arrayApplicantInfo);

		$task = "";

	}else if($task == 'EDIT'){

		if(isset($_POST["ereq1"])){
			$req1 = 1;
		}else{
			$req1 = 0;
		}

		if(isset($_POST["ereq2"])){
			$req2 = 1;
		}else{
			$req2 = 0;
		}

		if(isset($_POST["ereq3"])){
			$req3 = 1;
		}else{
			$req3 = 0;
		}

		if(isset($_POST["ereq4"])){
			$req4 = 1;
		}else{
			$req4 = 0;
		}

		if(isset($_POST["ereq5"])){
			$req5 = 1;
		}else{
			$req5 = 0;
		}

		if((isset($_POST["ereq1"])) && (isset($_POST["ereq2"])) && (isset($_POST["ereq3"])) && (isset($_POST["ereq4"])) && (isset($_POST["ereq5"]))){
			$req_stat = 1;
		}else{
			$req_stat = 0;
		}

		$strUpdateRequirements = $conn->prepare("
			UPDATE
				tbl_applicant_requirement
			SET
				fld_requirement1 = '".$req1."',
				fld_requirement2 = '".$req2."',
				fld_requirement3 = '".$req3."',
				fld_requirement4 = '".$req4."',
				fld_requirement5 = '".$req5."',
				fld_requirement_status = '".$req_stat."'
			WHERE
				tbl_applicant_requirement.fld_applicant_id = '".$_POST['txtHiddenApplicantIdR']."'
		");

		echo ($strUpdateRequirements->execute());

		$task = "";
	}

?>