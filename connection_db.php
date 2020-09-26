<?php

try{


	$username = 'root';
	$password = '';
	$database = 'mysql:dbname=twitter';
	$connection_db = new PDO($database, $username, $password);

	$connection_db->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// $connection = new
	// PDO("mysql:localhost; dbname=twitter","root","");
	// $connection->setAttribute(PDO::ATTR_ERRMODE,
	// PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $ex){
	echo $ex->getMessage();
	exit();
}