<?php

	$host = "68.183.192.58";
	$port = "5432";
	$username = "dbcoursestudent";
	$password = "<PASSWORD>";
	$dsn = "mysql:host=$host;dbname=tasks";
	$options = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	);
