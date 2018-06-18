<?php
	session_start();
	include('../includes/connection.php');

	$strGetAllApplicant = "
		SELECT
			*
		FROM
			tbl_id_report
		WHERE
			fld_date_released
		BETWEEN
			'".$_GET['datefrom']."'
		AND 
			'".$_GET['dateto']."'
	";

	$cmdGetAllApplicant = $conn->query($strGetAllApplicant);
	$rows = $cmdGetAllApplicant->rowCount();

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
				<center><span style="font-size: 14px;font-weight:bold;">List of Applicant with ID released from (<?php echo $_GET['dateto'];?>) to (<?php echo $_GET['dateto'];?>)</span></center>
				<br><br>
				<table id="log">
					<thead>
						<tr>
							<th>ID</th>
							<th>Fullname</th>
							<th>Address</th>
							<th>Position</th>
							<th>Released Date</th>
						</tr>		
					</thead>

					<tbody>
					<?php
						while($data=$cmdGetAllApplicant->fetch(PDO::FETCH_BOTH))
						{
							$applicantid 	= $data[0];
							$fullname 		= $data[1];
							$address 		= $data[2];
							$position 		= $data[3];
							$releaseddate 	= $data[4];
							
							echo "<tr>
									<td>".$applicantid."</td>
									<td>".$fullname."</td>
									<td>".$address."</td>
									<td>".$position."</td>
									<td>".$releaseddate."</td>
								</tr>";
						}

					?>
					</tbody>
				</table>
				<br>
				<div class="no-print">	
					<center><button class="btn btn-sm btn-success" onClick="window.print();" style="width: 100%;"><span class="fa fa-print"></span> Print</button></center>
				</div>
				<br>
			</div>
		</body>
	</html>