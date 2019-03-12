<?php
	session_start();
	include"../../lib/conn.php";
	include"../../lib/all_function.php";


	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	if(isset($_SESSION['supplier']) AND $_SESSION['supplier'] <> 'TRUE')
	{
		echo"<div class='w3-container w3-red'><p>Dilarang mengakses file ini.</p></div>";
		die();
	}

	if(isset($_GET['mod']) && isset($_GET['act']))
	{
		$mod = $_GET['mod'];
		$act = $_GET['act'];
	}
	else
	{
		$mod = "";
		$act = "";
	}

	if($mod == "supplier" AND $act == "simpan")
	{
		//variable input
		$kode_supplier = trim($_POST['id']);
		$nama_toko= anti_inject($_POST['nama_toko']);
		$alamat= anti_inject($_POST['alamat']);
		$telepon= anti_inject($_POST['telepon']);
		$email= anti_inject($_POST['email']);

		mysqli_query($id_mysql,"INSERT INTO tb_supplier('kode_supplier', 
										nama_toko, 
										alamat, 
										telepon, 
										email)
									VALUES ($kode_supplier, 
										'$nama_toko', 
										'$alamat', 
										'$telepon', 
										'$email')") or die(mysqli_error());
		flash('example_message', '<p>Berhasil menambah data biaya.</p>' );

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "supplier" AND $act == "edit") 
	{
		//variable input
		$kode_supplier = trim($_POST['id']);
		$nama_toko= anti_inject($_POST['nama_toko']);
		$alamat= anti_inject($_POST['alamat']);
		$telepon= anti_inject($_POST['telepon']);
		$email= anti_inject($_POST['email']);

		mysqli_query($id_mysql,"UPDATE tb_supplier SET 
										nama_toko= '$nama_toko', 
										alamat= '$alamat', 
										telepon= '$telepon', 
										email= '$email' 
					WHERE kode_supplier = '$_POST[id]'") or die(mysqli_error());

		flash('example_message', '<p>Berhasil mengubah data biaya.</p>');

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "supplier" AND $act == "hapus") 
	{
		mysqli_query($id_mysql,"DELETE FROM tb_supplier WHERE kode_supplier = '$_GET[id]'") or die(mysqli_error());
		flash('example_message', '<p>Berhasil menghapus data biaya kuliah.</p>' );
		echo"<script>
			window.history.back();
		</script>";	
	}

?>