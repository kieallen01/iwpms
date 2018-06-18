<?php
	session_start();
	include('../includes/connection.php');

	$task = $_GET["query"];

	if ($task == "TABLE") {

		$strGetListOfFees = "
			SELECT
				tbl_fees.fld_fee_id,
				tbl_fees.fld_fee_description,
				tbl_fees.fld_fee,
				tbl_fees.fld_date_created
			FROM
				tbl_fees
		";

		$cmdGetListOfFees = $conn->query($strGetListOfFees);
		$arrayGetListofFees = [];

		while ($data=$cmdGetListOfFees->fetch(PDO::FETCH_BOTH)) {
			
			$id 		  = $data[0];
			$fee_desc     = $data[1];
			$fee_cost     = $data[2];
			$date_created = $data[3];

			$rows = [
				'fee_id'		=> $id,
				'fee_desc'		=> $fee_desc,
				'fee_cost'	    => $fee_cost,
				'date_created'  => $date_created
			];

			array_push($arrayGetListofFees, $rows);
		}
		echo json_encode($arrayGetListofFees);

		$task = "";
	
	}elseif ($task == "ADD"){

		$feedescription = $_POST['feedescription'];
		$fee 			= $_POST['fee'];

		$strAddFees = $conn->prepare("
			INSERT INTO
				tbl_fees (fld_fee_description,fld_fee,fld_date_created)
			VALUES (
			'".$feedescription."',
			'".$fee."',
			'".date('Y-m-d')."'
			);
		");

		fnInsertLog('ADDED NEW FEE = '.$feedescription, $conn);
		echo ($strAddFees->execute());

		$task = "";

	}elseif ($task == "EDIT") {


		$feedescription = $_POST['efeedescription'];
		$fee 			= $_POST['efee'];	
		$strEditFee = $conn->prepare("
			UPDATE
				tbl_fees
			SET
				fld_fee_description = '".$_POST['efeedescription']."',
				fld_fee = '".$_POST['efee']."',
				fld_date_created = '".date('Y-m-d')."'
			WHERE
				fld_fee_id = '".$_POST['hiddenFeeId']."'
		");
		
		echo ($strEditFee->execute());
		fnInsertLog('EDIT FEE at = '.date('Y-m-d').' '.$feedescription, $conn);
		$task = "";

	}elseif ($task == "VIEW") {

		$strViewFee = "
			SELECT
				tbl_fees.fld_fee_id,
				tbl_fees.fld_fee_description,
				tbl_fees.fld_fee
			FROM
				tbl_fees
			WHERE
				tbl_fees.fld_fee_id = '".$_POST['fee_id']."'
		";

		$cmdViewFee = $conn->query($strViewFee);
		$arrayViewFee = [];

		while ($data=$cmdViewFee->fetch(PDO::FETCH_BOTH)) {
			
			$fee_id 	= $data[0];
			$fee_desc 	= $data[1];
			$fee 		= $data[2];

			$rows = [
				'fee_id'	=> $fee_id,
				'fee_desc'	=> $fee_desc,
				'fee'		=> $fee,
			];

			array_push($arrayViewFee, $rows);
		}
		echo json_encode($arrayViewFee);

		$task = "";

		
	}elseif ($task == "REMOVE") {

		$fee_id 	= $_POST["fee_id"];
		$fee_desc   = $_POST["fee_desc"];

		$strDeleteFee = $conn->prepare("
			DELETE FROM
				tbl_fees
			WHERE
				fld_fee_id = '".$fee_id."'

		");
		echo ($strDeleteFee->execute());

		$task = "";

	}elseif ($task == "FEES"){

		$strGetAllFees = "
			SELECT
				*
			FROM
				tbl_fees
		";

		$cmdGetAllFees = $conn->query($strGetAllFees);
		$arrayGetAllFees = [];

		while ($data=$cmdGetAllFees->fetch(PDO::FETCH_BOTH)) {
			
			$feeid 	 = $data[0];
			$feedesc = $data[1];
			$feecost = $data[2];

			$rows = [
				'feeid'   => $feeid,
				'feedesc' => $feedesc,
				'feecost' => $feecost
			];
			array_push($arrayGetAllFees, $rows);
		}
		echo json_encode($arrayGetAllFees);

		$task = "";
	}

	
?>