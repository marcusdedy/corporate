<head>

  <?php 

    session_start();
    $department = $_SESSION['department'];
    if(!isset($_SESSION['user_id']) && $department!="Buyer"){
		?>
			<script language="JavaScript">
				alert('Anda Harus Login. Silahkan Login kembali!');
				document.location='index.php';
			</script>
		<?php
    }
?>
	<?php
		include "config.php";
		if (isset($_GET['po_number'])) {
			$po_number	= $_GET['po_number'];
			$query	= "select * from 
							(select a.po_number, a.po_date, a.customer_id, b.customer_name, c.qty, c.total from 
							(select po_number, po_date, customer_id from purchase_order_header where file_name_detail ='')a,
							(select customer_id, customer_name from master_customer)b,
							(select po_number, sum(qty) as qty, sum(total) as total from purchase_order_detail group by po_number)c
							where a.po_number = c.po_number and a.customer_id = b.customer_id)a where a.po_number = '$po_number'";
			$hasil			= mysql_query($query);
			$data   		= mysql_fetch_array($hasil);
			$po_number   	= $data['po_number'];
			$po_date       	= $data['po_date'];
     	 	$customer_id    = $data['customer_id'];
			$customer_name  = $data['customer_name'];
			$qty 			= $data['qty'];
			$total 			= $data['total'];			

		}
		else {
			die ("Error. Tidak ada Data yang dipilih Silakan cek kembali! ");	
		}
	?>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<form action="proses-upload-file-po.php" method="POST" name="proses_upload_file_po" enctype="multipart/form-data">
	<table width="488" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr height="26">
				<td width="2%">&nbsp;</td>
				<td width="31%">&nbsp;</td>
				<td width="67%"><font color="orange" size="5"><b>Upload File PO</b></font></td>
			</tr>
		<tr height="36">
			<td height="27">&nbsp;</td>
			<td>PO Number</td>
			<td><input name="po_number" type="text" value="<?=$po_number?>" size="25" readonly /></td>
		</tr>
		<tr height="36">
			<td height="27">&nbsp;</td>
			<td>PO Date</td>
			<td><input name="po_date" type="text" value="<?=$po_date?>" size="25" readonly /></td>
		</tr>
		<tr height="36">
		  <td height="30">&nbsp;</td>
		  <td>Customer ID</td>
		  <td><input name="customer_id" type="text" value="<?=$customer_id?>" size="20" maxlength="20" readonly /></td>
	  </tr>
      <tr height="36">
		  <td height="28">&nbsp;</td>
		  <td>Customer Name</td>
		  <td><input name="remark" type="text" value="<?=$customer_name?>" size="40" readonly /></td>
	  </tr>
      <tr height="36">
		  <td height="35">&nbsp;</td>
		  <td>Qty</td>
		  <td><input name="qty" type="text" value="<?=$qty?>" size="5" readonly />
				Total	:	    
  					<input name="total" type="text" value="<?=$total?>" size="10" readonly />
	      </td>
	  </tr>
	  <tr height="36">
		  <td height="35">&nbsp;</td>
		  <td>File Attachment PO</td>
		  <td><input name="file_name_detail" id="file_name_detail" type="file" required /></td>
	  </tr>
		<tr height="36">
			<td>&nbsp;</td>
			<td>User</td>
			<td><input name="user_upload_file" type="text" value="<?php echo $_SESSION['user_id'];?>" size="25" maxlength="10" readonly /></td>
		</tr>
		<tr height="36">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input type="submit" class="btn btn-info" name="submit" value="Save" />&nbsp;&nbsp;&nbsp;
				
				<input type="button" class="btn btn-danger" value="Cancel" onClick="window.close();" title="Cancel" /></td>
		</tr>
		<tr height="36">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>

	</table>

</form>
<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
</div>