<?php

function dbConnection() {
	$server = "localhost";
	$username = "pgame1qs_test";
	$password = "paradise1.";
	$db = "pgame1qs_AdminPanel";

	$conn = new mysqli($server,$username,$password,$db);

	return $conn;
}

?>
