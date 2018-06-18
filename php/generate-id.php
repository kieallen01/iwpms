<?php
	session_start();
	date_default_timezone_set("Asia/Manila");
	include('../includes/connection.php');
	include('../plugins/barcode/src/BarcodeGenerator.php');
	include('../plugins/barcode/src/BarcodeGeneratorHTML.php');
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
			tbl_applicant_information.fld_applicant_id = '".$_GET['applicantid']."'
	";
	$cmdGetApplicantInfo = $conn->query($strGetApplicantInfo);

	while ($data=$cmdGetApplicantInfo->fetch(PDO::FETCH_BOTH)) {
		$applicantid 	= $data[0];
		$fullname		= $data[1].' '.$data[2].' '.$data[3];
		$gender 		= $data[4];
		$phone          = $data[6];
		$homeaddress 	= $data[9].', '.$data[8].', '.$data[7];
		$position 	 	= $data[10];
		$cbname 	 	= $data[12];

		$pnname 		= $data[17];
		$pnaddress 		= $data[18];
		$pnphone 		= $data[19];

		$image 			= $data[20];
	}

	$strInsertToListReportId = $conn->query("
		INSERT INTO
			tbl_id_report
		VALUES (
			'".$applicantid."',
			'".$fullname."',
			'".$homeaddress."',
			'".$position."',
			'".date('Y-m-d')."'
		)
	");

	if ($gender == 'Male') {
		$greet = 'Sir';
	}else{
		$greet = 'Maam';
	}

	$formatphonenumber = str_replace('+63','0',$phone);
	$phonenumber = str_replace('-','',$formatphonenumber);

	$message = 'Good Day! '.$greet.', '.$fullname.' your Identification Card is now ready for release.';
	
	itexmo($phonenumber,$message);

	$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
	$barcode   = $generator->getBarcode($applicantid, $generator::TYPE_CODE_128); 

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
			.label-id{
				color:#4885ed;
				font-size: 15px;
			}
		</style>
		<body style = "font-family: Helvetica;border:1px solid black;">

			<div>
				<img src="../includes/img/seal.png" width="120" height="120" style="position:absolute;left:10px;margin-top:20px;">	
				<span style="font-weight:bold;font-size:50px;color:#4885ed;"><center style="margin-left:200px;margin-top:30px;">MUNICIPALITY OF <br>BAUANG</center></span>
			</div>
			<br>
			
			<div style="background-color:#4885ed;padding:20px;color:white;font-size:24px;font-weight:bold;"><center> '.$cbname.'</center></div>
			
			<div style="margin-top:40px;margin-left:20px;width:170;height:185;background-color:#FF7F50;">
				<img src="../includes/img/applicant-images/'.$image.'" width="190" height="190" style="margin-top:30px;margin-left:18px;">
				<center><span style="font-weight:bold;font-size:20px;"> W - '.$applicantid.'</span></center>
			</div>

			<div style="position:absolute;left:230px;top:270px;">
				<div style="font-size:50px;font-weight:bolder;color:red;"><center>'.date('Y').'</center></div>
				<center><img src="../includes/img/tgis.png" width="350" height="170"></center>
			</div>
			<br>
			<div style="padding-top:40px;font-size:22px;">
				<center>
					<span style="font-weight:bold;">'.$fullname.'</span>
					<br>
					<small class="label-id">Name</small>
				</center>
			</div>
			
			<div style="padding-top:20px;font-size:22px;">
				<center>
					<span style="font-weight:bold;">'.$position.'</span>
					<br>
					<small class="label-id">Position</small>
				</center>
			</div>
			
			<div style="padding-top:20px;font-size:22px;">
				<center>
					<span style="font-weight:bold;">'.$homeaddress.'</span>
					<br>
					<small class="label-id">Address</small>
				</center>
			</div>
			<br><br>
			<div style="padding-top:20px;font-size:22px;">
				<center>
					<span style="font-weight:bold;">Eulogio Clarence Martin P. De Guzman</span>
					<br>
					<small class="label-id" style="color:black;">Municipal Mayor</small>
				</center>
			</div>
			<br><br>
			<div style="padding-top:50px;">
				<center><span style="font-size:35px;font-weight:bold;">IN CASE OF EMERGENCY PLEASE NOTIFY</span></center>
				<br><br><br>

				<table style="font-size: 20px;margin-left:60px;">
					<tr>
						<td><span>Name</span><td>
						<td><input type="text" style="width:490px;border:none;" value=":&nbsp;&nbsp;&nbsp;'.$pnname.'"><td>
					</tr>

					<tr>
						<td><span>Address</span><td>
						<td><input type="text" style="width:490px;border:none;" value=":&nbsp;&nbsp;&nbsp;'.$pnaddress.'"><td>
					</tr>

					<tr>
						<td>Contact No.</span><td>
						<td><input type="text" style="width:490px;border:none;" value=":&nbsp;&nbsp;&nbsp;'.$pnphone.'"><td>
					</tr>
				</table>
				<br><br><br>
			</div>

			<center style="margin-left:120px;"><p style="border-top:1px solid black;width:80%;font-size:20px;font-weight:bold;">Signature</p></center>
			<br><br><br><br><br><br>
			<center>
				<div style="color:#4885ed;font-weight:bold;font-size:40px;"> VALID UNTIL</div>
				<div style="color:red;font-size:40px;"> DECEMBER 31 '.date('Y').'</div>
				<div style="color:#4885ed;font-size:25px;"> unless sooner revoked or cancelled</div>
			</center>
		</body>
	</html>
	');

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('letter','portrait');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	($dompdf->stream("Individual Working Permit.pdf", ["Attachment" => false]));
?>