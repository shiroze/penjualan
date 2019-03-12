<?php
  global $id_mysql;

  $user = "root";
  $pass = "";
  $host = "localhost";
  $db = "db_tokosp";
  
  // $id_mysql = mysqli_connect($host,$user,$pass);
  // mysqli_select_db($id_mysql,$db);
  
  $db = new MySQLi($host,$user,$pass,$db);
  if ($db->connect_errno){
      echo "$db->connect_errno";
  }

	include"fungsi_flash.php";
?>