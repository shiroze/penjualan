<script src="js/chart/canvasjs.min.js"></script>
<script src="js/chart/jquery.canvasjs.min.js"></script>

<?php
	date_default_timezone_set('Asia/Jakarta');

	if(!isset($_SESSION['login_user'])){
		header('location: login.php'); // Mengarahkan ke Home Page
	}

?>

<div class="w3-padding-4 w3-tiny w3-blue"><marquee>Chaca Computer - Jl. Jendral A. Thalib No. 16 Simpang karya - Jambi</marquee></div>

<div class="w3-row-padding">
	<div class="w3-col s8">
		Dashboard
		<div style="border-bottom:1px dashed #ccc;"></div><br>

		<?php
			$jmlsup = mysqli_num_rows(mysqli_query($id_mysql,"SELECT * FROM tb_supplier"));
			$jmlpel = mysqli_num_rows(mysqli_query($id_mysql,"SELECT * FROM tb_pelanggan"));
			$jmlpj = mysqli_num_rows(mysqli_query($id_mysql,"SELECT * FROM tb_penjualan"));
			$jmlbrg = mysqli_num_rows(mysqli_query($id_mysql,"SELECT * FROM tb_barang"));
		?>

		<div class="w3-row-padding">
			<div class="w3-col s3">
				<div class="w3-card-4 w3-indigo w3-leftbar w3-border-red" style="width:100%;"><h3><b><i class="fa fa-cubes"></i><?php echo $jmlbrg; ?></b></h3>
				<span class="w3-tiny">Data Barang</span></div>
			</div>

			<div class="w3-col s3">
				<div class="w3-card-4 w3-indigo w3-leftbar w3-border-red" style="width:100%;"><h3><b><i class="fa fa-user"></i> <?php echo $jmlsup; ?></b></h3>
				<span class="w3-tiny">Data Supplier</span></div>
			</div>

			<div class="w3-col s3">
				<div class="w3-card-4 w3-indigo w3-leftbar w3-border-red" style="width:100%;"><h3><b><i class="fa fa-group"></i> <?php echo $jmlpel; ?></b></h3>
				<span class="w3-tiny">Data Pelanggan</span></div>
			</div>


			<div class="w3-col s3">
				<div class="w3-card-4 w3-indigo w3-leftbar w3-border-red" style="width:100%;"><h3><b><i class="fa fa-shopping-cart"></i> <?php echo $jmlpj; ?></b></h3>
				<span class="w3-tiny">Transaksi Penjualan</span></div>
			</div>
		</div>
	</div>
	<div class="w3-col s4 w3-card">
		User Login
		<div style="border-bottom:1px dashed #ccc;"></div><br>
		<table class='w3-table w3-tiny w3-striped'>
		<?php
			$sqluser = mysqli_query($id_mysql,"SELECT * FROM user 
									WHERE id_user <> '$_SESSION[login_id]' 
									ORDER BY last_login DESC");
			while ($u = mysqli_fetch_assoc($sqluser)) {
				echo"<tr style='border-bottom:1px dashed #ccc;'>
					<td>".strtoupper($u['nama_lengkap'])."</td>
					<td>".strtoupper($u['level'])."</td>
					<td>$u[last_login]</td>
				</tr>";
			}

		?>
		</table><br>

		10 Barang Paling Laris
		<div style="border-bottom:1px solid #ccc;"></div><br>
		<table class='w3-table w3-tiny w3-striped'>
		<?php
			$rlaris = mysqli_query($id_mysql,"SELECT * FROM barang_laris 
									ORDER BY jumlah DESC LIMIT 10");
			$no = 1;
			while ($b = mysqli_fetch_assoc($rlaris)) {
				echo"<tr style='border-bottom:1px dashed #ccc;'>
					<td>$no.</td>
					<td>".strtoupper($b['kode_barang'])."</td>
					<td>".strtoupper($b['nama_barang'])."</td>
				</tr>";

				$no++;
			}

		?>
		</table><br>
		<?php
		if(isset($_SESSION['level']) AND ($_SESSION['level'] == "admin")) :
		?>
		Aktifitas Transaksi
		<div style="border-bottom:1px solid #ccc;"></div><br>
		<table class='w3-table w3-tiny w3-striped'>
		<?php
			$rlog = mysqli_query($id_mysql,"SELECT * FROM tb_log 
									ORDER BY id_log DESC LIMIT 10");
			$no = 1;
			while ($l = mysqli_fetch_assoc($rlog)) {
				echo"<tr style='border-bottom:1px dashed #ccc;'>
					<td>$no.</td>
					<td><i>$l[timestmp] - ".$l['deskripsi']."</i></td>
				</tr>";

				$no++;
			}

		?>
		</table><br>
		<?php
		endif;
		?>
	</div>
</div>