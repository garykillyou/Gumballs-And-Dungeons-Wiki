<?php

function getGumballDetail($faction, $gName) {
	$connect = new mysqli ( "localhost", "Gary", "135792468", "gumballs" );
	if ($connect->connect_error) {
		die ( 'Connect Error: ' . $connect->connect_error );
	}
	
	$sql = sprintf ( "SELECT * FROM `%s` WHERE `Name` = '%s';", $faction, $gName );
	$result = $connect->query ( $sql );
	
	$out = $result->fetch_all ( MYSQLI_ASSOC );
	$connect->close ();
	echo json_encode ( $out );
}

if (isset ( $_GET["faction"], $_GET["gName"] )) {
	getGumballDetail ( $_GET["faction"], $_GET["gName"] );
}
else
	echo "ERROR!!!";
?>
