<?php

$rootdir = '../';


require $rootdir."local/connection.local.php";

$connection = true;
$unittest = true;

if( $connection ){

	$conn = mysqli_connect( $connectionParameters['host'], $connectionParameters['username'], $connectionParameters['password']);


	// Check connection
	if ( $unittest ) {
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		echo "Connected successfully";
	}


	$selectdb = mysqli_select_db($conn, $connectionParameters['database']);

	if ( $unittest ) {
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		echo "database selected";
	}

}


