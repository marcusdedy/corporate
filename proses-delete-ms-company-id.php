<?php
	include "config.php";
	if (isset($_GET['company_id'])) {
		$company_id = $_GET['company_id)'];
	//membaca nama file yang akan dihapus
	$query   = "SELECT * FROM master_company WHERE company_id='$company_id'";
	$hasil   = mysql_query($query);
	$data    = mysql_fetch_array($hasil);
	}
	else {
		die ("Error. Tidak ada Data yang dipilih Silakan cek kembali! ");	
	}
	//proses delete data
		if (!empty($company_id) && $company_id != "") {
			$hapus = "DELETE FROM master_company WHERE company_id='$company_id'";
			$sql = mysql_query ($hapus);
			if ($sql) {		
				?>
				<script language="JavaScript">
		alert('Company <?=$company_id?> Berhasil Dihapus!');
		document.location='home-finance.php?page=form-ms-approval&mu_username=<?=$_SESSION['mu_username']?>';
		</script>
				<?php		
			} else {
				echo "<h2><font color=red><center>Data gagal dihapus!</center></font></h2>";	
			}
		}
	
?>