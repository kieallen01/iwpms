<?php
	session_start();
	include("../includes/connection.php");

	$applicantid = $_POST['applicantid'];

	$strSelectPenaltyDate = $conn->query("
		SELECT
			*
		FROM
			tbl_penalty
		WHERE
			fld_penalty_status = '1'
	");

	while ($data=$strSelectPenaltyDate->fetch(PDO::FETCH_BOTH)) {
		$penaltyrate = $data[2];
		$penaltydate = $data[3];
	}

	$strCheckPenalty = "
		SELECT
			MAX(fld_date_of_payment) as fld_date_of_payment,
			fld_total
		FROM
			tbl_fees_collection
		WHERE
			fld_applicant_id = '".$_POST['applicantid']."'
	";

	$cmdCheckPenalty = $conn->query($strCheckPenalty);


	while ($data=$cmdCheckPenalty->fetch(PDO::FETCH_BOTH)) {
		$paymentdate  = $data['fld_date_of_payment'];
		$totalpayment = $data['fld_total'];
	}

	$d1 = date('Y', strtotime($paymentdate));
	$d2 = date('Y', strtotime($penaltydate));

	$yearcount = $d1 - $d2;
	$today = date('Y-m-d');

	$penalty = NULL;

	if ($today>=$penaltydate) {
		$penalty = (($penaltyrate / 100) * $totalpayment) * abs($yearcount);
	}else{
		$penalty = 0;
	}	

	$arrayPaymentDetails = [];

	$rows = [
		'applicantid' => $applicantid,
		'penalty' 	  => $penalty
	];

	array_push($arrayPaymentDetails, $rows);

	echo json_encode($arrayPaymentDetails);
	

?>