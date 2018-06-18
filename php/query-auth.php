<?php
	session_start();
	include("../includes/connection.php");

	$task = $_GET["query"];

	if ($task == "LOGIN") { //LOGIN--------------------------------------------------------

		$strLogin = "
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
			AND
				DES_DECRYPT(fld_password) = '".$_POST['password']."'
			AND
				fld_account_status = 1
		";

		$cmdLogin = $conn->query($strLogin);
		$rowCount = $cmdLogin->rowCount();
		if ($rowCount > 0) {
			$arrayLogin = [];
			while($data=$cmdLogin->fetch(PDO::FETCH_BOTH)){
				$username 			= 		$data[0];
				$first_name 		= 		$data[1];
				$middle_name 		= 		$data[2];
				$last_name 			= 		$data[3];
				$user_level 		= 		$data[4];
				$account_status 	= 		$data[5];
				$fullname			=		ucwords($data[3].', '.$data[1].' '.$data[2]);

				$_SESSION["login"] 				= true;
				$_SESSION["configuration"]		= date('Y');
				$_SESSION["username"] 			= $username;        	
				$_SESSION["first_name"] 		= $first_name;
				$_SESSION["middle_name"] 		= $middle_name;
				$_SESSION["last_name"] 			= $last_name;
				$_SESSION["user_level"] 		= $user_level;
				$_SESSION["account_status"] 	= $account_status;
				$_SESSION["fullname"] 			= $fullname;

				$rows = [
					"username" 				=> $_SESSION["username"],
					"first_name" 			=> $_SESSION["first_name"],
					"middle_name" 			=> $_SESSION["middle_name"],
					"last_name" 			=> $_SESSION["last_name"],
					"user_level" 			=> $_SESSION["user_level"],
					"account_status" 		=> $_SESSION["account_status"],
					"fullname" 				=> $_SESSION["fullname"]
				];
				array_push($arrayLogin, $rows);
			}

			fnInsertLog('LOGGED IN', $conn);
			echo json_encode($arrayLogin);

			$task = "";

		}else{

			echo 0;

			$task = "";
		}

	}elseif ($task == "LOGOUT") { //LOGOUT------------------------------------------------

		fnInsertLog('LOGGED OUT', $conn);

		unset($_SESSION["login"]); 				
		unset($_SESSION["username"]); 			      	
		unset($_SESSION["first_name"]); 		
		unset($_SESSION["middle_name"]); 		
		unset($_SESSION["last_name"]); 			
		unset($_SESSION["user_level"]); 		
		unset($_SESSION["account_status"]);	

		$task = "";

	}else{	// NO QUERY TO BE DONE--------------------------------------------------------

		echo "Something went wrong!";
	}

	

?>