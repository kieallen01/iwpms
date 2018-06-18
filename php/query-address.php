<?php
	include ("../includes/connection.php");

	if ($_GET["q"] == "province") {
		$strGetProvinces = "
			SELECT
				tbl_address_province.fld_address_province_code,
				tbl_address_province.fld_address_province_desc
			FROM
				tbl_address_province
			ORDER BY
				tbl_address_province.fld_address_province_desc;
		";
		$cmdGetProvinces = $conn->query($strGetProvinces);
		$arrayGetProvinces = [];
		while ($data=$cmdGetProvinces->fetch(PDO::FETCH_BOTH)) {
			$provincecode = $data[0];
			$provincedesc = $data[1];
			$rows = [
				"provincecode"	=>	$provincecode,
				"provincedesc"	=>	$provincedesc
			];
			array_push($arrayGetProvinces,$rows);
		}
		echo json_encode($arrayGetProvinces);
	}
	else if ($_GET["q"] == "citymun") {
		$strGetCityMuns = "
			SELECT
				tbl_address_citymun.fld_address_citymun_code,
				tbl_address_citymun.fld_address_citymun_desc
			FROM
				tbl_address_citymun
			WHERE
				tbl_address_citymun.fld_address_province_code = '".$_GET["code"]."';
		";
		$cmdGetCityMuns = $conn->query($strGetCityMuns);
		$arrayGetCityMuns = [];
		while ($data=$cmdGetCityMuns->fetch(PDO::FETCH_BOTH)) {
			$citymuncode = $data[0];
			$citymundesc = $data[1];
			$rows = [
				"citymuncode"=>$citymuncode,
				"citymundesc"=>$citymundesc
			];
			array_push($arrayGetCityMuns,$rows);
		}
		echo json_encode($arrayGetCityMuns);
	}
	else if ($_GET["q"] == "brgy") {
		$strGetBrgys = "
			SELECT
				tbl_address_brgy.fld_address_brgy_code,
				tbl_address_brgy.fld_address_brgy_desc
			FROM
				tbl_address_brgy
			WHERE
				tbl_address_brgy.fld_address_citymun_code = '".$_GET["code"]."';
		";
		$cmdGetBrgys = $conn->query($strGetBrgys);
		$arrayGetBrgys = [];
		while ($data=$cmdGetBrgys->fetch(PDO::FETCH_BOTH)) {
			$brgycode = $data[0];
			$brgydesc = $data[1];
			$rows = [
				"brgycode"=>$brgycode,
				"brgydesc"=>$brgydesc
			];
			array_push($arrayGetBrgys,$rows);
		}
		echo json_encode($arrayGetBrgys);
	}
?>