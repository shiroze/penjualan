<?php
	session_start();
	include"../../lib/conn.php";
	include"../../lib/all_function.php";


	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	if(isset($_SESSION['kategori']) AND $_SESSION['kategori'] <> 'TRUE')
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

	if($mod == "kategori" AND $act == "simpan")
	{
		//variable input
		$kategori_id = trim($_POST['id']);
		$nama_kategori= anti_inject($_POST['nama_kategori']);

		mysqli_query($id_mysql,"INSERT INTO tb_kategori_barang(kategori_id, 
										nama_kategori)
									VALUES ('$kategori_id', 
										'$nama_kategori')") or die(mysqli_error());
		flash('example_message', '<p>Berhasil menambah data biaya.</p>' );

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "kategori" AND $act == "edit") 
	{
		//variable input
		$kategori_id = trim($_POST['id']);
		$nama_kategori= anti_inject($_POST['nama_kategori']);

		mysqli_query($id_mysql,"UPDATE tb_kategori_barang SET 
										nama_kategori= '$nama_kategori' 
					WHERE kategori_id = '$_POST[id]'") or die(mysqli_error());

		flash('example_message', '<p>Berhasil mengubah data biaya.</p>');

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "kategori" AND $act == "hapus") 
	{
		mysqli_query($id_mysql,"DELETE FROM tb_kategori_barang WHERE kategori_id = '$_GET[id]'") or die(mysqli_error());
		flash('example_message', '<p>Berhasil menghapus data biaya kuliah.</p>' );
		echo"<script>
			window.history.back();
		</script>";	
	}

?>