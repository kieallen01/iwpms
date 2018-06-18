<?php
	session_start();
	include("../includes/connection.php");

	$task 	 = $_GET['query'];

	if ($task == "TABLE") { // GET USER TABLE DATA ------------------------------------------------------	

		$strGetAllUsers = "
			SELECT 
				tbl_users.fld_username,
				tbl_users.fld_user_level,
				tbl_users.fld_first_name,
				tbl_users.fld_middle_name,
				tbl_users.fld_last_name,
				tbl_users.fld_account_status
			FROM
				tbl_users
		";

		$cmdGetAllUsers = $conn->query($strGetAllUsers);
		$arrayGetAllUsers = [];
		while ($data=$cmdGetAllUsers->fetch(PDO::FETCH_BOTH)) {
			$username  		= $data[0]; 
			$user_level 	= $data[1]; 
			$fullname 		= $data[4].', '.$data[2].' '.$data[3];
			$account_status = $data[5];

			$rows = [
				"username" 		 => $username,
				"user_level" 	 => $user_level,
				"fullname" 		 => $fullname,
				"account_status" => $account_status
			];
			array_push($arrayGetAllUsers, $rows); 	
		}
		echo json_encode($arrayGetAllUsers);

		$task = "";

	}elseif ($task == "ADD") { // ADD USER  --------------------------------------------------------------

		$userlevel 	= $_POST['userlevel'];
		$fname		= $_POST['fname'];
		$mname		= $_POST['mname'];
		$lname		= $_POST['lname'];
		$username	= $_POST['username'];
		$password	= $_POST['password'];

		$strChekUser = "
			SELECT 
				*
			FROM
				tbl_users
			WHERE 
				fld_username = '".$username."'
			";

		$cmdLogin = $conn->query($strChekUser);
		$rowCount = $cmdLogin->rowCount();

		if ($rowCount >= 1) {

			echo "EXIST";

		}else{

			$strAddUser = $conn->prepare("
				INSERT INTO
					tbl_users
				VALUES (
					'".$username."', 
					DES_ENCRYPT('".$password."'),
					'".ucwords($fname)."',
					'".ucwords($mname)."',
					'".ucwords($lname)."',
					'".$userlevel."',
					'1'
				);
			");
			fnInsertLog('ADD NEW USER = '.$username, $conn);
			echo ($strAddUser->execute());

		}

		$task = "";

	}elseif ($task == 'EDIT'){

		$strEditUser = $conn->query("
			UPDATE
				tbl_users
			SET
				fld_first_name= '".$_POST['efname']."',
				fld_middle_name = '".$_POST['emname']."',
				fld_last_name = '".$_POST['elname']."',
				fld_user_level = '".$_POST['euserlevel']."'
			WHERE
				fld_username = '".$_POST['hiddenUsername']."'

		");

		echo ($strEditUser->execute());

		$task = "";

	}elseif ($task == "VIEW"){
		
		$strGetUserView = "
			SELECT 
				tbl_users.fld_username,
				tbl_users.fld_first_name,
				tbl_users.fld_middle_name,
				tbl_users.fld_last_name,
				tbl_users.fld_user_level,
				tbl_users.fld_account_status
			FROM
				tbl_users
			WHERE
				fld_username = '".$_POST['username']."'
		";

		$cmdGetUserView = $conn->query($strGetUserView);
		$arrayGetUserView = [];

		while ($data=$cmdGetUserView->fetch(PDO::FETCH_BOTH)) {
			$username 	 =	$data[0];
			$user_fname  =	$data[1];
			$user_mname  =	$data[2];
			$user_lname  =	$data[3];
			$user_level  =	$data[4];
			$user_status =	$data[5];

			$rows = [
				'username' 		=> $username,
				'user_fname' 	=> $user_fname,
				'user_mname' 	=> $user_mname,
				'user_lname' 	=> $user_lname,
				'user_level' 	=> $user_level,
				'user_status' 	=> $user_status
			];
			array_push($arrayGetUserView, $rows);
		}
		echo json_encode($arrayGetUserView);

		$task = "";

	}elseif ($task == "DEAC0"){

		if ($_SESSION['username'] == $_POST['username']) {
			echo "ACTIVE";
		}else{

			$strDeactivateUser = $conn->prepare("
				UPDATE
					tbl_users
				SET
					fld_account_status = '0'
				WHERE
					fld_username = '".$_POST['username']."'

			");

			fnInsertLog('DEACTIVATE USER = '.$_POST['username'], $conn);
			echo ($strDeactivateUser->execute());

		}

		$task = "";

	}elseif ($task == "DEAC1"){

		$strDeactivateUser = $conn->prepare("
			UPDATE
				tbl_users
			SET
				fld_account_status = '0'
			WHERE
				fld_username = '".$_POST['username']."'

		");
		fnInsertLog('DEACTIVATED USER ACCOUNT = '.$_POST['username'], $conn);
		echo ($strDeactivateUser->execute());

		$task = "";

	}elseif ($task == "ACTI") {
		
		$strActivateUser = $conn->prepare("
			UPDATE
				tbl_users
			SET
				fld_account_status = '1'
			WHERE
				fld_username = '".$_POST['username']."'

		");
		fnInsertLog('ACTIVATED USER ACCOUNT = '.$_POST['username'], $conn);
		echo ($strActivateUser->execute());

		$task = "";

	}else{ // NO QUERY TO BE DONE------------------------------------------------------------------------

		echo "Something went wrong!";
	}
?>