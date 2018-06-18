<?php
	include('../includes/connection.php');

	$strGetActivityLog = $conn->query("
		SELECT 
			* 
		FROM 
			tbl_activity_log 
		WHERE
			fld_date 
		BETWEEN
			'".$_GET['datefrom']."'
		AND 
			'".$_GET['dateto']."'
	");

	$rows = $strGetActivityLog->rowCount();
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
				<center><span style="font-size: 14px;font-weight:bold;">Activity Log Report from (<?php echo $_GET['dateto'];?>) to (<?php echo $_GET['dateto'];?>)</span></center>
				<br><br>
				<table id="log">
					<thead>
						<tr>
							<th>ID</th>
							<th>Username</th>
							<th>Activity</th>
							<th>Date</th>
							<th>Time</th>
						</tr>		
					</thead>

					<tbody>
					<?php
						while($data=$strGetActivityLog->fetch(PDO::FETCH_BOTH))
						{
							echo "<tr>
									<td>".$data[0]."</td>
									<td>".$data[1]."</td>
									<td>".$data[2]."</td>
									<td>".$data[3]."</td>
									<td>".$data[4]."</td>
								</tr>";
						}
					?>
					</tbody>
				</table>
				<br>
				<div class="no-print">	
					<center><button class="btn btn-sm btn-success" onClick="window.print();" style="width: 100%;"><span class="fa fa-print"></span> Print Activity Log</button></center>
				</div>
				<br>
			</div>
		</body>
	</html>