	
	<?php
	include "config.php";
	
		$id 				= $_POST['po_number'];
		$po_number   		= $_POST['po_number'];
		$qty        		= $_POST['qty'];
		$total				= $_POST['total'];
		$faktur				= $_POST['faktur'];
		$date_faktur		= $_POST['date_faktur'];
		$user_input_faktur	= $_POST['user_input_faktur'];
		$update_date_faktur	= DATE("Y-m-d h:i:sa");

	//validasi data jika data kosong
	if (empty($_POST['faktur'])) {
	?>
		<script language="JavaScript">
		alert('PO <?=$po_number?> Failed Update!');
		window.close();
		</script>
	<?php
	}
	else {
	$input	="insert into faktur_jual (faktur, date_faktur, tot_qty, tot_price, po_number, user_input_faktur, update_date_faktur) 
	values ('$faktur', '$date_faktur', '$qty', '$total', '$po_number', '$user_input_faktur', '$update_date_faktur')";
	$query_input =mysql_query($input);

		if ($query_input) {
		//Jika Sukses
	?>
		<script language="JavaScript">
		alert('Successfully Updated PO Number <?=$po_number?> With Faktur <?=$faktur?> !!!');
		window.close();
		</script>
	<?php
	}
	else {
	//Jika Gagal
	echo "Failed Update, Please Try Again!";
	}
	}

?>
</body>
        
        
        