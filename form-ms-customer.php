
<?php
include "config.php";
?>

    <h6><font color="orange" size="5"><u>MS Customer</u></font>       <u>
    <left></left>
    </u></h6>
<form action="home-buyer.php?page=form-ms-customer" method="post" name="postform">
  <table width="546" border="0" align="left">
<tr>
  <td width="69">&nbsp;</td>
    <td width="159">Search Name</td>
    <td width="304" colspan="2"><input type="text" name="customer_name" value="<?php if(isset($_POST['customer_name'])){ echo $_POST['customer_name']; }?>"/></td>
</tr>

<tr>
  <td align="center" >&nbsp;</td>
    <td align="center" ><a href="javascript:void(0);"
    onclick="window.open('form-buat-ms-customer.php','nama_window_pop_up','height = 400, width = 950, resizable = 0')">++ New Customer</a></td>
    <td><input type="submit" value="Show Data" name="cari"></td>

    
</tr> 
</table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<p>

<?php
//di proses jika sudah klik tombol cari
if(isset($_POST['cari'])){
	
	$customer_name=$_POST['customer_name'];

	
	if(empty($customer_name) ){
		$Tampil=mysql_query("select * from master_customer");
		$jumlah=mysql_fetch_array(mysql_query("select count(customer_name)total from master_customer"));
		
	}else{
		// create by Marcuz Dedy
		?>
		<?php
		
		$Tampil=mysql_query("select * from master_customer where mc_customer_name like '%$mc_customer_name%'");
		$jumlah=mysql_fetch_array(mysql_query("select count(mc_customer_name)total from master_customer where mc_customer_name like '%$mc_customer_name%'"));
	}
	
	?>
</p>

<table width="1206" border="0" align="center" cellpadding="0" cellspacing="1">
	<tr bgcolor="#0066FF">
		<th width="5%" height="25"><font color="#FFFFFF">No</font></td>&nbsp;
		<th width="10%"><font color="#FFFFFF">Cust Id</font>      
	  	<th width="17%"><font color="#FFFFFF">Cust Name</font>      
	  	<th width="23%"><font color="#FFFFFF">Address</font>
      	<th width="10%"><font color="#FFFFFF">Phone</font>
      	<th width="10%"><font color="#FFFFFF">Comp ID</font>
      	<th width="15%"><font color="#FFFFFF">For Attention</font>     
      	<th width="10%"><font color="#FFFFFF">Action</font></td>&nbsp; 
	</tr>

	<?php
		$no=0;
	
    while (	$hasil = mysql_fetch_array ($Tampil)) {
			$customer_id 		= stripslashes ($hasil['customer_id']);
			$customer_name		= stripslashes ($hasil['customer_name']);
			$customer_address 	= stripslashes ($hasil['customer_address']);
			$phone_number 		= stripslashes ($hasil['phone_number']);
			$company_id 		= stripslashes ($hasil['company_id']);
			$for_attention 		= stripslashes ($hasil['for_attention']);
		{
	?>
	
    <tr align="center">
    	<td height="19" bgcolor="#EEF2F7"><?php echo $no=$no+1; ?></td>
    	<td align="center" bgcolor="#EEF2F7"><?=$customer_id?></td>
    	<td align="center" bgcolor="#EEF2F7"><?=$customer_name?></td>
      	<td align="center" bgcolor="#EEF2F7"><?=$customer_address?></td>
      	<td align="center" bgcolor="#EEF2F7"><?=$phone_number?></td>
      	<td align="center" bgcolor="#EEF2F7"><?=$company_id?></td>
      	<td align="center" bgcolor="#EEF2F7"><?=$for_attention?></td>
		<td bgcolor="#EEF2F7"><div align="center">
        <a href="javascript:void(0);"
    onclick="window.open('form-edit-ms-customer.php?mc_id_cust=<?php echo $mc_id_cust; ?>','nama_window_pop_up','height = 400, width = 950, resizable = 0')">Edit</a>
        || <a href="home-customer.php?page=proses-hapus-ms-customer&mc_id_cust=<?=$mc_id_cust?>">Hapus</a></div></td>
    </tr>
    <tr>
    	<td colspan="15" align="center"> 
		<?php
		//jika data tidak ditemukan
		if(mysql_num_rows($Tampil)==0){
			echo "<font color=red><blink>Tidak ada data yang dicari!</blink></font>";
		}
		?>
        
        </td>
    </tr>

<?php  
		}
	
}

?>
</table>
<?php
}else{
	unset($_POST['cari']);
}
?>
</div>


