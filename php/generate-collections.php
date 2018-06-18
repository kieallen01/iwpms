<?php
	include('../includes/connection.php');

	$strGetSum = $conn->query("
		SELECT 
			SUM(fld_total) as total,
			SUM(fld_penaltypayment) as penaltytotal
		FROM 
			tbl_fees_collection
		WHERE
			fld_date_of_payment 
		BETWEEN
			'".$_GET['datefrom']."'
		AND 
			'".$_GET['dateto']."'
	");

	while ($data=$strGetSum->fetch(PDO::FETCH_BOTH)) {
		$grandtotal = $data['total']+$data['penaltytotal'];
	}


	$strGetFeeCollections = $conn->query("
		SELECT 
			* 
		FROM 
			tbl_fees_collection
		WHERE
			fld_date_of_payment 
		BETWEEN
			'".$_GET['datefrom']."'
		AND 
			'".$_GET['dateto']."'
	");

	$rows = $strGetFeeCollections->rowCount();

	$strGetFeeCollectionsPenalty = $conn->query("
		SELECT 
			tbl_fees_collection.fld_or_number,
			tbl_fees_collection.fld_applicant_id,
			tbl_fees_collection.fld_date_of_payment,
			tbl_fees_collection.fld_penaltypayment  
		FROM 
			tbl_fees_collection
		WHERE
			fld_date_of_payment 
		BETWEEN
			'".$_GET['datefrom']."'
		AND 
			'".$_GET['dateto']."'
		GROUP BY
			fld_or_number
		AND
			fld_date_of_payment
	");

	while ($data=$strGetFeeCollectionsPenalty->fetch(PDO::FETCH_BOTH)) {
		$or 			= $data[0];
		$id 			= $data[1];
		$dateofpayment  = $data[2];
		$penaltypay  	= $data[3];

	}

?>

<!DOCTYPE html>
	<html lang="en">
		<head>
			<title>Individual Working Permit</title>
		</head>
			<link rel="stylesheet" type="text/css" href="../plugins/bootstrap/dist/css/bootstrap.css">
		    <link rel="stylesheet" type="text/css" href="../plugins/font-awesome/css/font-awesome.min.css">
		<style>
			#log {
			    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			    border-collapse: collapse;
			    width: 100%;
			    font-size:14px;
			}

			#log td, #log th {
			    border: 1px solid #aaa;
			    padding: 8px;
			}
			
			#log th {
			    padding-top: 12px;
			    padding-bottom: 12px;
			    text-align: left;
			    color: black;
			    text-align:center;
			}
			@media print{

			    .no-print, .no-print *
			    {
			        display: none !important;
			    }

			}
		</style>
		<body style = "font-family: Helvetica;">
			<div class="container">
				<div>
					<center><img src="../includes/img/seal.png" width="80" height="80"></center>	
					<center><span style="font-size: 14px;">Republic of the Philippines</span></center>
					<center><span style="font-size: 14px;">Province of La Union</span></center>
					<center><span style="font-weight:bold;font-size:16px;">MUNICIPALITY OF BAUANG</span></center><br>
				</div>
				<center><span style="font-weight: bolder; font-size: 20px;">INDIVIDUAL WORKING PERMIT MANAGEMENT SYSTEM</span></center>
				<br>
				<center><span style="font-size: 14px;font-weight:bold;">Collection Report from (<?php echo $_GET['datefrom'];?>) to (<?php echo $_GET['dateto'];?>)</span></center>
				<br><br>
				<table id="log">
					<thead>
						<tr>
							<th>Applicant ID</th>
							<th>OR Number</th>
							<th>Fee Description</th>
							<th>Payment Date</th>
							<th>Fee's Paid</th>
						</tr>		
					</thead>

					<tbody>
					<?php
						while($data=$strGetFeeCollections->fetch(PDO::FETCH_BOTH))
						{
						echo "<tr>
								<td>".$data[5]."</td>
								<td>".$data[0]."</td>
								<td>".$data[2]."</td>
								<td>".$data[4]."</td>
								<td>".$data[3]."</td>
							</tr>";
						}
						echo "<tr>
								<td>".$id."</td>
								<td>".$or."</td>
								<td>Penalty Payment</td>
								<td>".$dateofpayment."</td>
								<td>".$penaltypay."</td>
							</tr>";
					?>
					</tbody>
				</table>
					<label style="font-size: 30px;" class="pull-right">GRAND TOTAL : &#8369; <?php echo $grandtotal;?></label>
				<br><br>
				<div class="no-print">	
					<center><button class="btn btn-sm btn-success" onClick="window.print();" style="width: 100%;"><span class="fa fa-print"></span> Print</button></center>
				</div>
				<br>
			</div>
		</body>
	</html>