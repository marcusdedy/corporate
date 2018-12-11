<body bgcolor="#EEF2F7">

<?php
	include "config.php";
	
	$po_number			= $_POST['po_number'];
	$user_upload_file	= $_POST['user_upload_file'];
	$upload_file_date	= DATE("Y-m-d h:i:sa");


	$lokasi_file = $_FILES['file_name_detail']['tmp_name'];
	$nama_file   = $_FILES['file_name_detail']['name'];
	$folder = "files/po/$nama_file";
	

	//validasi data jika data kosong
	if (empty(	$_POST['po_number'])) {
	?>
		<script language="JavaScript">
			alert('Cek Ulang File!');
			window.close();
		</script>
	<?php
	}
	
	else {
	
	$input	= "update purchase_order_header set file_name_detail = replace('$nama_file',' ',''), user_upload_file = '$user_upload_file', upload_file_date = '$upload_file_date' where po_number = '$po_number'";
	$query_input =mysql_query($input);

		if (move_uploaded_file($lokasi_file,"$folder")) {
		//Jika Sukses
	?>	
		<script language="JavaScript">
		alert('Proses Simpan Berhasil!');
		window.close();
		</script>
	<?php
	}
	else {
	//Jika Gagal
	echo "Gagal Proses, Silahkan diulangi!";
	}
	}

?>
</body>