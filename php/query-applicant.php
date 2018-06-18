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

	}else if ($task == "EDIT") {

		$efname  	= ucwords($_POST["eappFname"]);
		$emname 	= ucwords($_POST["eappMname"]);
		$elname 	= ucwords($_POST["eappLname"]);
		$egender 	= $_POST["eappGender"];
		$ephone 	= $_POST["eappPhoneNumber"];
		$edob 		= $_POST["eappDateOfBirth"];
		$eprovPB 	= $_POST["eappProvPB"];
		$ecitymunPB = $_POST["eappMunPB"];
		$ebrgyPB 	= $_POST["eappBarPB"];
		$eprovHA 	= $_POST["eappProvHA"];
		$ecitymunHA = $_POST["eappMunHA"];
		$ebrgyHA 	= $_POST["eappBarHA"];
		$eposition  = ucwords($_POST["eappPD"]);
		$ecbname 	= ucwords($_POST["eappCBName"]);
		$ecbaddress = ucwords($_POST["eappCBAdd"]);
		$eempname  	= ucwords($_POST["eappEmpName"]);

		$epnname  	= ucwords($_POST["eappPNName"]);
		$epnaddress = ucwords($_POST["eappPNAdd"]);
		$epnphone  	= ucwords($_POST["eappPhoneNumber"]);  
		
		$strEditApplicant = $conn->prepare("
			UPDATE
				tbl_applicant_information
			SET
				fld_applicant_fname = '".$efname."',
				fld_applicant_mname = '".$emname."',
				fld_applicant_lname = '".$elname."',
				fld_applicant_gender = '".$egender."',
				fld_phone = '".$ephone."',
				fld_applicant_dob = '".$edob."',
				fld_pob_prov = '".$eprovPB."',
				fld_pob_citymun = '".$ecitymunPB."',
				fld_pob_bar = '".$ebrgyPB."',
				fld_add_prov = '".$eprovHA."',
				fld_add_citymun = '".$ecitymunHA."',
				fld_add_bar = '".$ebrgyHA."',
				fld_position = '".$eposition."',
				fld_cb_add = '".$ecbname."',
				fld_cb_name = '".$ecbaddress."',
				fld_emp_name = '".$eempname."',
				fld_pnotif_name = '".$epnname."',
				fld_pnotif_address = '".$epnaddress."',
				fld_pnotif_phone = '".$epnphone."'
			WHERE
				fld_applicant_id = '".$_POST['txtHiddenApplicantId']."'
		");
		echo ($strEditApplicant->execute());

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
				tbl_applicant_information.fld_add_bar,

				tbl_applicant_information.fld_pnotif_name,
				tbl_applicant_information.fld_pnotif_address,
				tbl_applicant_information.fld_pnotif_phone,
				tbl_applicant_information.fld_applicant_image

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

			$pnname	 		= $data[17];
			$pnaddress		= $data[18];
			$pnphone	 	= $data[19];

			$image 			= $data[20];

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
				'brgycodeha' 	=> $brgycodeha,
				'pnname' 		=> $pnname,
				'pnaddress' 	=> $pnaddress,
				'pnphone' 		=> $pnphone,
				'image'			=> $image
			];
			array_push($arrayApplicantInfo, $rows);
		}
		echo json_encode($arrayApplicantInfo);

		$task = "";

	}elseif ($task == "ADD") {
		
		$fname  	= ucwords($_POST["appFname"]);
		$mname 		= ucwords($_POST["appMname"]);
		$lname 		= ucwords($_POST["appLname"]);
		$gender 	= $_POST["appGender"];
		$phone 		= $_POST["appPhoneNumber"];
		$dob 		= $_POST["appDateOfBirth"];
		$provPB 	= $_POST["appProvPB"];
		$citymunPB  = $_POST["appMunPB"];
		$brgyPB 	= $_POST["appBarPB"];
		$provHA 	= $_POST["appProvHA"];
		$citymunHA  = $_POST["appMunHA"];
		$brgyHA 	= $_POST["appBarHA"];
		$position   = ucwords($_POST["appPD"]);
		$cbname 	= ucwords($_POST["appCBName"]);
		$cbaddress  = ucwords($_POST["appCBAdd"]);
		$empname  	= ucwords($_POST["appEmpName"]);
		$pnname 	= ucwords($_POST["appPNName"]);
		$pnaddress  = ucwords($_POST["appPNAdd"]);
		$pnphone  	= ucwords($_POST["appPNPhoneNumber"]);

		if(isset($_POST["req1"])){
				$req1 = 1;
		}else{
			$req1 = 0;
		}

		if(isset($_POST["req2"])){
				$req2 = 1;
		}else{
			$req2 = 0;
		}

		if(isset($_POST["req3"])){
				$req3 = 1;
		}else{
			$req3 = 0;
		}

		if(isset($_POST["req4"])){
				$req4 = 1;
		}else{
			$req4 = 0;
		}

		if(isset($_POST["req5"])){
				$req5 = 1;
		}else{
			$req5 = 0;
		}

		if((isset($_POST["req1"])) && (isset($_POST["req2"])) && (isset($_POST["req3"])) && (isset($_POST["req4"])) && (isset($_POST["req5"]))){
			$req_stat = 1;
		}else{
			$req_stat = 0;
		}

		$strAddWalkinApplicant = $conn->prepare("
			INSERT INTO
				tbl_applicant_information
			VALUES(
				null,
				'".$fname."',
				'".$mname."',
				'".$lname."',
				'".$gender."',
				'".$phone."',
				'".$dob."',
				'".$provPB."',
				'".$citymunPB."',
				'".$brgyPB."',
				'".$provHA."',
				'".$citymunHA."',
				'".$brgyHA."',
				'".$position."',
				'".$cbname."',
				'".$cbaddress."',
				'".$empname."',
				'".$pnname."',
				'".$pnaddress."',
				'".$pnphone."',
				''
			)
		"); 

		$strAddWalkinRequirement = $conn->prepare("
			INSERT INTO
				tbl_applicant_requirement
			VALUES(null,'".$req1."','".$req2."','".$req3."','".$req4."','".$req5."',1,'".$req_stat."'
			)");
			
		$strAddApplication = $conn->prepare("
			INSERT INTO
				tbl_application_details
			VALUES(null,'Office','".date('Y-m-d')."','N',''
			)");

		if ($strAddWalkinApplicant->execute()) {
			if ($strAddWalkinRequirement->execute()) {
				if ($strAddApplication->execute()) {
					echo true;
				}else{
					echo false;
				}
			}else{
				echo false;
			}
		}else{
			echo false;
		}

		$task = "";

	}elseif ($task == 'REL_DATE') {
		
		$strUpdateReleaseDate = $conn->prepare("
			UPDATE
				tbl_application_details
			SET
				fld_released_year = '".date('Y')."',
				fld_released_date = '".date('Y-m-d')."'
			WHERE
				fld_applicant_id = '".$_POST['applicantid']."'
		");
		
		echo ($strUpdateReleaseDate->execute());
	}

?>