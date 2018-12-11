	
	<?php
	include "config.php";
	
		$id 				= $_POST['customer_id'];
		$customer_id 		= $_POST['customer_id'];
		$customer_name		= $_POST['customer_name'];
		$customer_address	= $_POST['customer_address'];
		$phone_number		= $_POST['phone_number'];
		$company_id			= $_POST['company_id'];
		$for_attention		= $_POST['for_attention'];
		$user_update		= $_POST['user_update'];
		$update_date		= DATE("Y-m-d h:i:sa");

	//validasi data jika data kosong
	if (empty($_POST['customer_id'])) {
	?>
		<script language="JavaScript">
		alert('Customer <?=$customer_id?> Gagal Diinput!');
		window.close();
		</script>
	<?php
	}
	else {
	//Masukan data ke Table bayar
	$input	="insert into master_customer (customer_id, customer_name, customer_address, phone_number, company_id, for_attention, user_update, update_date) values ('$customer_id', '$customer_name', '$customer_address', '$phone_number', '$company_id', '$for_attention', '$user_update', '$update_date') ";
	$query_input =mysql_query($input);

		if ($query_input) {
		//Jika Sukses
	?>
		<script language="JavaScript">
		alert('Customer <?=$customer_id?> <?=$customer_name?> Berhasil Diinput!');
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
        
        
        