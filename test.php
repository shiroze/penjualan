<?php
    date_default_timezone_set('Asia/Jakarta');
    include "class/paging.php";
    include "session.php";
    include "lib/fungsi_indotgl.php";
    include "lib/all_function.php";
?>
<html>
  <head>
    <title>This is Test Page</title>
  </head>
  <body>
    <p>Hi Test body here</p>
    <?php
      $query = "SELECT * FROM tb_barang";
			$sql_kul = $db->query($query);
      while($row = mysqli_fetch_assoc($sql_kul)) {
        echo "Nama Barang : ".$row['nama_barang']."<br />";
        echo "Kategori : ".nama_kategori($row['kategori_id'])."<br /><br />";
      }
    ?>
  </body>
</html>