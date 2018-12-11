<?php
	include "config.php";
	if (isset($_GET['po_number'])) {
		$po_number = $_GET['po_number'];
	//membaca nama file yang akan diinput
	$query   = "SELECT * FROM purchase_order_header WHERE po_number='$po_number'";
	$hasil   = mysql_query($query);
	$data    = mysql_fetch_array($hasil);
	}
	else {
		die ("Error. No Data Please check again! ");	
	}
	//proses insert data
		if (!empty($po_number) && $po_number != "") {

			$delete_detail = "delete from purchase_order_detail where po_number = '$po_number'";
			$sql = mysql_query ($delete_detail);

			$delete_header = "delete from purchase_order_header where po_number = '$po_number'";
			$sql = mysql_query ($delete_header);

			if ($sql) {		
				?>
					<script language="JavaScript">
					alert('Successful Delete Data !!!');
					document.location='home-buyer.php?page=form-view-delete-po&user_id=<?=$_SESSION['user_id']?>';
					</script>
				<?php		
			} else {
				echo "<h2><font color=red><center>Data gagal dihapus!</center></font></h2>";	
			}
		}
	mysql_close($Open);
?>