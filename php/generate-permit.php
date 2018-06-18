<?php
	session_start();
	date_default_timezone_set("Asia/Manila");
	include('../includes/connection.php');
	require '../plugins/vendor/autoload.php';
	use Dompdf\Dompdf;

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
			tbl_applicant_information.fld_pnotif_phone

		FROM
			tbl_applicant_information
		INNER JOIN
			tbl_address_province ON tbl_applicant_information.fld_add_prov = tbl_address_province.fld_address_province_code
		INNER JOIN
			tbl_address_citymun ON tbl_applicant_information.fld_add_citymun = tbl_address_citymun.fld_address_citymun_code
		INNER JOIN 
			tbl_address_brgy ON tbl_applicant_information.fld_add_bar = tbl_address_brgy.fld_address_brgy_code
		WHERE
			tbl_applicant_information.fld_applicant_id = '".$_GET['applicantid']."'
	";
	$cmdGetApplicantInfo = $conn->query($strGetApplicantInfo);

	while ($data=$cmdGetApplicantInfo->fetch(PDO::FETCH_BOTH)) {
		$applicantid 	= $data[0];
		$fullname		= $data[1].' '.$data[2].' '.$data[3];
		$homeaddress 	= $data[9].', '.$data[8].', '.$data[7];

		$position 	 	= $data[10];
		$cbname 	 	= $data[12];
	}

	$strSelectSignatory = "
		SELECT
			tbl_signatories.fld_signatory_id,
			tbl_signatories.fld_signatory_fname,
			tbl_signatories.fld_signatory_mname,
			tbl_signatories.fld_signatory_lname,
			tbl_signatories.fld_signatory_status,
			tbl_signatories.fld_signatory_office
		FROM
			tbl_signatories
		WHERE
			fld_signatory_status = '1'
	";

	$cmdGetSignatory = $conn->query($strSelectSignatory);

	while ($data=$cmdGetSignatory->fetch(PDO::FETCH_BOTH)) {

		$signatorystatus = $data[4];
		$signatoryoffice = $data[5];

		if ($signatoryoffice == "Office of the Mayor") {

			$mayor = $data[1].' '.substr($data[2], 0, 1).'. '.$data[3];

		}elseif ($signatoryoffice == "Premits and Licensing Office") {

			$asignatory = $data[1].' '.substr($data[2], 0, 1).'. '.$data[3];

		}
	}

	$strInsertToListReportIWP = $conn->query("
		INSERT INTO
			tbl_iwp_report
		VALUES (
			'".$applicantid."',
			'".$fullname."',
			'".$homeaddress."',
			'".$position."',
			'".$mayor."',
			'".$asignatory."',
			'".date('Y-m-d')."'
		)
	");

	header ("Content-type: application/pdf");
	// instantiate and use the dompdf class
	$dompdf = new Dompdf();
	define("DOMPDF_ENABLE_REMOTE", true);
	$dompdf->loadHtml('
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<title>Print</title>
		</head>
		<style>
			input{
				padding:0px;
			}
		</style>
		<body style = "font-family: Helvetica;margin-top:50px;">

			<div>
				<img src="../includes/img/sulong.jpg" width="150" height="50" style="position:absolute;right:20px;top:25px;">
				<img src="../includes/img/seal.png" width="100" height="100" style="position:absolute;left:10px;">	
				<center><span style="font-size: 18px;">Republic of the Philippines</span></center>
				<center><span style="font-size: 18px;">Province of La Union</span></center>
				<center><span style="font-weight:bold;font-size:24px;">MUNICIPALITY OF BAUANG</span></center>
			</div>
			<br><br><br>
			<table style="width:100%;margin-left:20px;margin-right:20px;font-family:Times New Roman;">
				<tr>
					<td><input type="checkbox"> <span style="display:inline-block;font-size:12px;">NEW</span></td>
					<td><div style="text-align:right;">NO. <span style="font-size:24px;font-weight:bold">'.$applicantid.' - '.substr(date('Y'),2).'</span></div></td>
				</tr>
				<tr>
					<td><input type="checkbox"> <span style="display:inline-block;font-size:12px;">RENEWAL</span></td>
				</tr>
			</table>
			<br>
			<center><span style="font-weight: bolder; font-size: 34px;">INDIVIDUAL WORKING PERMIT</span></center>
			<br><br>

			<table style="font-size: 18px;margin-left:30px;">
				<tr>
					<td><span>is hereby granted to</span><td>
					<td><input type="text" style="width:490px;border:none;border-bottom: 1px solid black;" value="'.$fullname.'"><td>
				</tr>

				<tr>
					<td><span>a resident of</span><td>
					<td><input type="text" style="width:490px;border:none;border-bottom: 1px solid black;" value="'.$homeaddress.'"><td>
				</tr>

				<tr>
					<td><span>to work as a</span><td>
					<td><input type="text" style="width:490px;border:none;border-bottom: 1px solid black;" value="'.$position.'"><td>
				</tr>

				<tr>
					<td><span>at</span><td>
					<td><input type="text" style="width:490px;border:none;border-bottom: 1px solid black;" value="'.$cbname.'"><td>
				</tr>
			</table>

				<p style="margin-left: 43px;font-size: 18px;">
					subject however, to compliance to all existing laws and ordinances governing the same.
				</p>

				<p style="padding-top: 10px;margin-left: 43px;font-size: 18px;text-indent: 60px;">
					This <strong>PERMIT</strong> shall be valid until December 31, '.date("Y").' unless sooner revoked for caused or in the interest of public safety and welfare.
				</p>

				<p style="font-size:18px;text-indent: 60px;margin-left: 43px;">Issued this '.date("jS").' day of '.date("F").', '.date("Y").' at Bauang, La Union.</p>
				<br>
				
				<table style="width:100%;">
					<tr>
						<td>

						</td>

						<td style="width:55%;">
							<span style="font-size: 15px;"><br><center>'.strtoupper($mayor).'</center><center><small>Municipal Mayor</small></center></span><br>		
						</td>
					</tr>
				</table>
				<br>
				<span style="text-align:left;font-size:12px;margin-left:300px;">FOR THE MAYOR:</span>

				<table style="width:100%;">
					<tr>
						<td>

						</td>

						<td style="width:55%;">
							<br><br><br>
							<span style="font-size: 15px;"><center>'.strtoupper($asignatory).'</center><center><small>Authorized Signatory</small></center></span><br>		
						</td>
					</tr>
				</table>

				<img src="../includes/img/smoke.png" width="120" height="120" style="position:absolute;left:100px;top:640px;">
				<img src="../includes/img/tgis.png" width="280" height="100" style="position:absolute;margin-left:30px;bottom:290px;">
				
				<br><br><br><br>
				<div style="border:1px solid black;width:48%;margin-left:20px;padding:5px;">
					<table style="font-family:13px; font-family: Times New Roman;">
						<tr>
							<td style="width:150px;"><span>Paid under OR No.</span></td>
							<td><input type="text" value="&nbsp;&nbsp;&nbsp;7518428" style="width:180px;border:none;border-bottom: 1px solid black;"></td>
						</tr>

						<tr>
							<td><span>Date of Payment</span></td>
							<td><input type="text" value="&nbsp;&nbsp;&nbsp;'.date('Y-m-d').'" style="width:180px;border:none;border-bottom: 1px solid black;"></td>
						</tr>
					</table>
					<table style="font-family:13px; font-family: Times New Roman;">
						<tr>
							<td><span style="width:50px;">Annual Mayors Permit Fee</span></td>
							<td><input type="text" value="P&nbsp;&nbsp;&nbsp;200" style="width:155px;border:none;border-bottom: 1px solid black;"></td>
						</tr>

						<tr>
							<td><span>Police Clearance Fee</span></td>
							<td><input type="text" value="P&nbsp;&nbsp;&nbsp;60" style="width:155px;border:none;border-bottom: 1px solid black;"></td>
						</tr>

						<tr>
							<td>Health Permit Fee</span></td>
							<td><input type="text" value="P&nbsp;&nbsp;&nbsp;15" style="width:155px;border:none;border-bottom: 1px solid black;"></td>
						</tr>
						<tr>
							<td>ID Fee</span></td>
							<td><input type="text" value="P&nbsp;&nbsp;&nbsp;15" style="width:155px;border:none;border-bottom: 1px solid black;"></td>
						</tr>

						<tr style="padding-top:20px;">

							<td><span style="margin-right: 50px;">TIN</span></td>
							<td><input type="text" style="width:155px;border:none;"></td>
						</tr>
					</table>
				</div>
				<div style="position:absolute;width:300px;bottom:50px;right:10px;">
					<center><img src="../includes/img/rediscover.jpg" width="180" height="80"></center>
					<br><br><br>
					<hr style="width:95%;">
					<center><small style="font-style:italic;">Signature</small></center>				
				</div>
				
		</body>
	</html>
	');

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('legal', 'portrait');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	($dompdf->stream("Individual Working Permit.pdf", ["Attachment" => false]));
?>