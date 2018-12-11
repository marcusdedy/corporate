	
	<?php
	include "config.php";
	
		$id 			= $_POST['company_id'];
		$company_id 	= $_POST['company_id'];
		$company_name	= $_POST['company_name'];
		$update_date	= DATE("Y-m-d h:i:sa");

	//validasi data jika data kosong
	if (empty($_POST['company_id'])) {
	?>
		<script language="JavaScript">
		alert('Company <?=$company_id?> Gagal Diinput!');
        window.close();
		</script>
	<?php
	}
	else {
	//Masukan data ke Table bayar
	$input	="insert into master_company (company_id, company_name, update_date)
                    values ('$company_id', '$company_name', '$update_date')";
	$query_input =mysql_query($input);

		if ($query_input) {
		//Jika Sukses
	?>
		<script language="JavaScript">
		alert('Company <?=$company_id?> <?=$company_name?> Berhasil Diinput!');
		window.close();
		</script>
	<?php
	}
	else {
	//Jika Gagal
	echo "Gagal Diinput, Silahkan diulangi!";
	}
	}
	//Tutup koneksi engine MySQL

?>
</body>
        
        
        