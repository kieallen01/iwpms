<?php
	session_start();
	include('../includes/connection.php');

	$strGetListOfSignatory = "
		SELECT
			tbl_signatories.fld_signatory_id,
			tbl_signatories.fld_signatory_fname,
			tbl_signatories.fld_signatory_mname,
			tbl_signatories.fld_signatory_lname,
			tbl_signatories.fld_signatory_position,
			tbl_signatories.fld_signatory_office,
			tbl_signatories.fld_signatory_status
		FROM
			tbl_signatories
		WHERE
			fld_signatory_status = '1'
		AND
			fld_signatory_office = 'Treasury Office'
	";

	$cmdGetListOfSignatory = $conn->query($strGetListOfSignatory);
	$arrayGetListofSignatory = [];

	while ($data=$cmdGetListOfSignatory->fetch(PDO::FETCH_BOTH)) {
		$signatory_fullname = $data[1].' '.$data[2].' '.$data[3];
	}


	$strGetAppInfo = $conn->query("
		SELECT
			tbl_applicant_information.fld_applicant_fname,
			tbl_applicant_information.fld_applicant_mname,
			tbl_applicant_information.fld_applicant_lname
		FROM
			tbl_applicant_information
		WHERE
			fld_applicant_id = '".$_GET['applicantid']."'
	");

	while ($data=$strGetAppInfo->fetch(PDO::FETCH_BOTH)) {
		$fullname = $data[0].' '.$data[1].' '.$data[2];
	}

	$strGetPaymentInfo = "
		SELECT
			fld_or_number,
			fld_fee_desc,
			fld_fee_cost,
			fld_total,
			fld_penaltypayment
		FROM
			tbl_fees_collection
		WHERE
			fld_applicant_id = '".$_GET['applicantid']."'
		AND
			fld_date_of_payment = '".$_GET['paymentdate']."'
		AND
			fld_or_number = '".$_GET['ornumber']."'
	";

	$cmdPaymentInfo = $conn->query($strGetPaymentInfo);
?>

<!DOCTYPE html>
	<html lang="en">
		<head>
			<title>Individual Working Permit</title>
		</head>
			<link rel="stylesheet" type="text/css" href="../plugins/bootstrap/dist/css/bootstrap.css">
		    <link rel="stylesheet" type="text/css" href="../plugins/font-awesome/css/font-awesome.min.css">
		<style>
			@media print{
			    .no-print, .no-print *
			    {
			        display: none !important;
			    }

			}
		</style>

		<script type="text/javascript">
			setTimeout(function(){
			   window.location.reload(1);
			}, 1000);
		</script>

		<body style = "font-family: Helvetica;" onload="myfunction();">
			<div class="container">
				<br>
		
				<div style="margin-left: 50px;"><?php echo date('F m, Y');?></div><br>
				<div style="margin-left: 50px;">MUNICIPALITY OF BAUANG</div><br>
				<div style="margin-left: 50px;"><?php echo $fullname;?></div>
				<table id="receipt_table">
					<?php
						while ($data=$cmdPaymentInfo->fetch(PDO::FETCH_BOTH)) {
						echo "<tr>
								<td>".$data[1]."</td>
								<td style='padding-left:220px;'>".$data[2]."</td><br>
							</tr>";
						}
						if ($_GET['penaltyfee']>0) {
							echo "<tr>
								<td>Penalty Fee</td>
								<td style='padding-left:220px;'>".$_GET['penaltyfee']."</td><br>
							</tr>";
						}
					?>
					<?php ?>
				</table>
				<br>
				<p style="margin-left: 350px;font-weight: bold;">&#8369; <?php echo $_GET['total']+$_GET['penaltyfee'];?></p>
				<p><?php echo convert_number_to_words($_GET['total']).' Pesos only';?></p>
				<br><br><br>
				<table style="font-size: 14px;">
					<tr>
						<td><?php echo $_SESSION['fullname'];?></td>
						<td style="padding-left:100px;text-align: center;"><?php echo $signatory_fullname;?></td>
					</tr>
					<tr>
						<td style="text-align: center;">Teller</td>
						<td style="padding-left:100px;text-align: center">Municipal Treasurer</td>
					</tr>
				</table>
				<div class="no-print">	
					<center><button class="btn btn-sm btn-success" onClick="window.print();"><span class="fa fa-print"></span> Print </button></center>
				</div>
			</div>
		</body>
	</html>