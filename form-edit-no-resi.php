<div style="border:0; padding:10px; width:924px; height:auto;">
<?php 

    session_start();
    $mu_access = $_SESSION['mu_access'];
    if(!isset($_SESSION['mu_username']) && $mu_access!="Warehouse"){
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
		if (isset($_GET['cih_invoice_number'])) {
			$cih_invoice_number   = $_GET['cih_invoice_number'];
			$query   = " select * from corp_inv_hdr where cih_invoice_number ='$cih_invoice_number'";
			$hasil   			= mysql_query($query);
			$data    			= mysql_fetch_array($hasil);
			$cih_invoice_number	 	= $data['cih_invoice_number'];
			$cih_mc_customer_name	= $data['cih_mc_customer_name'];
			$cih_total 				= $data['cih_total'];
			$cih_resi_number		= $data['cih_resi_number'];

		}
		else {
			die ("Error. Tidak ada No Invoice yang dipilih Silakan cek kembali! ");	
		}
	?>
<form action="home-warehouse.php?page=proses-input-no-resi" method="POST" name="form_input_no_resi" >
	<table width="796" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr height="26">
				<td width="10%">&nbsp;</td>
				<td width="19%">&nbsp;</td>
				<td width="71%"><font color="orange" size="3"><b>Form Edit No Resi</b></font></td>
			</tr>
		<tr height="36">
			<td height="32">&nbsp;</td>
			<td>No Invoice</td>
			<td><strong>:</strong>			  <input name="cih_invoice_number" type="text" value="<?=$cih_invoice_number?>" size="35" readonly="readonly" />
		  </td>
		</tr>
		<tr height="36">
		  <td height="25">&nbsp;</td>
		  <td>Customer Name</td>
		  <td><strong>:</strong>		    <input name="cih_mc_customer_name" type="text" value="<?=$cih_mc_customer_name?>" size="70" maxlength="100" readonly="readonly" /></td>
	  </tr>
      	  </tr>
      		<tr height="36">
		  <td height="29">&nbsp;</td>
		  <td>Tot Rupiah</td>
		  <td><strong>:</strong>		    <input name="cih_total" type="text" value="<?=$cih_total?>" size="15" readonly="readonly" /></td>
	  </tr>
		<tr height="36">
			<td height="30">&nbsp;</td>
			<td>No Resi</td>
			<td><strong>:</strong>
			  <input type="text" name="cih_resi_number" value="<?=$cih_resi_number?>" size="25" maxlength="25" /></td>

        		</tr>
		<tr height="36">
			<td>&nbsp;</td>
			<td>User</td>
			<td><strong>:</strong>			  <input name="cph_user_input_faktur_do" type="text" value="<?php echo $_SESSION['mu_username'];?>" size="30" maxlength="30" readonly="readonly" /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="36">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Save" >&nbsp;&nbsp;&nbsp;
				<input type="reset" name="reset" value="Reset">
				<input type="button" value="Cancel" onclick="window.close();" title="Cancel" /></td>
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