<?php
	$host = "localhost";
	$user = "c3root";
	$pass = "MgeMmH2_";
	$db = "c3db4dmstikom";


	$conn = mysql_connect($host, $user, $pass) or die("Tidak terkoneksi ke server!");
	if ($conn) {
		$dbselect = mysql_select_db($db, $conn) or die("Tidak terhubung ke Database.");
	}

?>