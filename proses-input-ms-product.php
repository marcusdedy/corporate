	
	<?php
	include "config.php";
	
		$id 				= $_POST['product_id'];
		$product_id 		= $_POST['product_id'];
		$product_name		= $_POST['product_name'];
		$cost				= $_POST['cost'];
		$margin				= $_POST['margin'];
		$price				= $_POST['price'];
		$status				= $_POST['status'];
		$user_update		= $_POST['user_update'];
		$update_date		= DATE("Y-m-d h:i:sa");

	//validasi data jika data kosong
	if (empty($_POST['product_id'])) {
	?>
		<script language="JavaScript">
		alert('Product <?=$product_id?> Gagal Diinput!');
		window.close();
		</script>
	<?php
	}
	else {
	//Masukan data ke Table bayar
	$input	="insert into master_product (product_id, product_name, cost, margin, price, status, update_date, user_update) 
	values ('$product_id', '$product_name', '$cost', '$margin', '$price', '$status', '$update_date', '$user_update')";
	$query_input =mysql_query($input);

		if ($query_input) {
		//Jika Sukses
	?>
		<script language="JavaScript">
		alert('Product <?=$product_id?> <?=$product_name?> Berhasil Diinput!');
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
        
        
        