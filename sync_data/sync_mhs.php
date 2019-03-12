<?php
	include"conn.php";

	$q = mysqli_query($id_mysql,"SELECT * FROM mahasiswa 
		WHERE gelombang = '$_GET[gel]' AND angkatan = '$_GET[ta]' AND jur = '$_GET[jur]'") 
	or die(mysql_error());

	if ($q) {
		$po = array();
		if (mysql_num_rows($q)) {
			while ($p = mysql_fetch_assoc($q)) {
				$po[] = $p;
			}
		}

		echo json_encode(array('mhs' => $po));
		//echo $po;
	}

?>