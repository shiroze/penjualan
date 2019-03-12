<link rel="stylesheet" type="text/css" href="../../css/pace.css">
<script src="../../js/pace.min.js"></script>
<?php
	date_default_timezone_set('Asia/Jakarta');
	session_start();
	include"../../lib/conn.php";
	include"../../lib/all_function.php";
	include"../../lib/fungsi_transaction.php";


	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
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

	if($mod == "returpembelian" AND $act == "simpan")
	{

		$resCekRetur = mysqli_query($id_mysql,"SELECT * FROM tb_detail_pembelian 
									WHERE no_faktur ='$_POST[no_faktur]' 
									AND kode_barang = '$_POST[barang]'");
		if (mysqli_num_rows($resCekRetur) > 0) {
			$r = mysqli_fetch_assoc($resCekRetur);

			if($_POST['qty'] <= $r['qty'])
			{
				$resSimpan = mysqli_query($id_mysql,"INSERT INTO tb_retur_pembelian(no_faktur, 
															kode_barang, 
															harga_beli, 
															qty, 
															petugas, 
															keterangan, 
															timestmp)
													VALUES('$_POST[no_faktur]', 
															'$_POST[barang]', 
															$r[harga_beli], 
															$_POST[qty], 
															'$_SESSION[login_id]', 
															'$_POST[keterangan]', 
															NOW())");

				if(!$resSimpan)
				{
					flash('example_message', '<p>Barang sudah pernah di retur.</p>', 'w3-red' );
					echo"<script>
						window.history.back();
					</script>";	
					//echo"Barang sudah pernah di retur!";
				}
				else
				{
					flash('example_message', '<p>Retur barang berhasil di simpan.</p>' );
					echo"<script>
						window.history.back();
					</script>";	
					//echo"Berhasil retur barang";
				}
			}
			else
			{
				flash('example_message', '<p>Jumal barang tidak sesuai.</p>', 'w3-yellow' );
				echo"<script>
					window.history.back();
				</script>";	
				//echo"Jumlah barang tidak sesuai...";
			}

		}
		else
		{
			flash('example_message', '<p>Tidak ditemukan transaksi dan kode barang.</p>', 'w3-yellow' );
			echo"<script>
				window.history.back();
			</script>";	
			//echo"Tidak ditemukan transaksi dan kode barang...";
		}

	}

	elseif ($mod == "returpembelian" AND $act == "hapus") {
		mysqli_query($id_mysql,"DELETE FROM tb_retur_pembelian 
			WHERE no_faktur = '$_GET[id]' AND kode_barang = '$_GET[kode]'") or die(mysqli_error());
		flash('example_message', '<p>Berhasil menghapus data transaksi.</p>' );
		echo"<script>
			window.history.back();
		</script>";	
	}
?>