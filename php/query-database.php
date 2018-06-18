<?php
	include("../includes/connection.php");

	$task = $_GET["query"];

	if ($task == "BACKUP") {

		$db_host = 'localhost';
		$db_name = 'db_iwpms';
		$db_user = 'root';
		$db_pass= '';

		$db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$return = '';
		$allTables = array();
		$result = $db->prepare("SHOW TABLES");
		$result->execute();
		$result = $result->fetchAll(PDO::FETCH_ASSOC);

		foreach ($result as $row) {
			$allTables[] = $row['Tables_in_'.$db_name];
		}

		foreach($allTables as $table){

			$result = $db->prepare("SELECT * FROM $table");
			$result->execute();
			
			$num_fields = $result->columnCount();
			$result = $result->fetchAll(PDO::FETCH_BOTH);
			$return.= 'DROP TABLE IF EXISTS '.$table.';';
			$row2 = $db->prepare("SHOW CREATE TABLE $table");
			$row2->execute();
			$row2 = $row2->fetchAll(PDO::FETCH_ASSOC);
			$return.= "\n\n".$row2[0]['Create Table'].";\n\n";

			foreach ($result as $row) {

				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++){

					$row[$j] = addslashes($row[$j]);
					$row[$j] = str_replace("\n","\\n",$row[$j]);

					if (isset($row[$j])) {
						$return.= '"'.$row[$j].'"' ;
					}else{
						$return.= '""';
					}
					if ($j<($num_fields-1)) { 
						$return.= ','; 
					}
				}
				$return.= ");\n";
			}
			$return.="\n\n";
		}

		$folder = '../backup/';

		if (!is_dir($folder)){
			mkdir($folder, 0777, true);
			chmod($folder, 0777);
		}

		$date = date('m-d-Y-H-i-s', time());
		$filename = $folder."db_iwpms-".$date;
		$handle = fopen($filename.'.sql','w+');

		fwrite($handle,$return);
		fclose($handle);


		if(!is_file($folder.'/.htaccess')){

			$htaccess = fopen($folder.'/.htaccess','w+');
			$htaccessDeny = 'deny from all';

			fwrite($htaccess,$htaccessDeny);
			fclose($htaccess);
		}
		echo true;

		$task = "";

	}else if ($task == "RESTORE"){

		$file = $_FILES["sql"]["tmp_name"];
		$sql = file_get_contents($file);
		$qr = $conn->exec($sql);
		echo true;

		$task = "";
	}

?>

