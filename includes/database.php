<?php
	//DATABASE CONFIG
	$databaseConfig = parse_ini_file('databaseConfig.ini');
	$dbDriver = $databaseConfig['driver'];
	$dbHost = $databaseConfig['host'];
	$dbName = $databaseConfig['name'];
	$dbUsername = $databaseConfig['username'];
	$dbPassword = $databaseConfig['password'];
	$dbCharset = $databaseConfig['charset'];
?>