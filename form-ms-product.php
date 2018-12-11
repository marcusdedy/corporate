
<?php
include "config.php";
?>

    <h6><font color="orange" size="5"><u>MS Product</u></font>       <u>
    <left></left>
    </u></h6>
<form action="home-buyer.php?page=form-ms-product" method="post" name="postform">
  <table width="546" border="0" align="left">
<tr>
  <td width="69">&nbsp;</td>
    <td width="159">Search Product Name</td>
    <td width="304" colspan="2"><input type="text" name="product_name" value="<?php if(isset($_POST['product_name'])){ echo $_POST['product_name']; }?>"/></td>
</tr>

<tr>
  <td align="center" >&nbsp;</td>
    <td align="center" ><a href="javascript:void(0);"
    onclick="window.open('form-buat-ms-product.php','nama_window_pop_up','height = 450, width = 750, top = 70, left = 50, resizable = 0')">++ New Product</a></td>
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
	
	$product_name=$_POST['product_name'];

	
	if(empty($product_name) ){
		$Tampil=mysql_query("select * from master_product");
		$jumlah=mysql_fetch_array(mysql_query("select count(product_id)total from master_product"));
		
	}else{
		// create by Marcuz Dedy
		?>
		<?php
		
		$Tampil=mysql_query("select * from master_product where product_name like '%$product_name%'");
		$jumlah=mysql_fetch_array(mysql_query("select count(product_id)total from master_product where product_name like '%$product_name%'"));
	}
	
	?>
</p>

<table width="1206" border="0" align="center" cellpadding="0" cellspacing="1">
	<tr bgcolor="#0066FF">
		<th width="5%" height="25"><font color="#FFFFFF">No</font></td>&nbsp;
		<th width="15%"><font color="#FFFFFF">ProductID</font>      
	  	<th width="35%"><font color="#FFFFFF">Product Name</font>      
	  	<th width="10%"><font color="#FFFFFF">Cost</font>
      	<th width="10%"><font color="#FFFFFF">Margin</font>
      	<th width="10%"><font color="#FFFFFF">Price</font>
      	<th width="5%"><font color="#FFFFFF">Status</font>     
      	<th width="10%"><font color="#FFFFFF">Action</font></td>&nbsp; 
	</tr>

	<?php
		$no=0;
	
    while (	$hasil = mysql_fetch_array ($Tampil)) {
			$product_id 	= stripslashes ($hasil['product_id']);
			$product_name	= stripslashes ($hasil['product_name']);
			$cost 			= stripslashes ($hasil['cost']);
			$margin 		= stripslashes ($hasil['margin']);
			$price 			= stripslashes ($hasil['price']);
			$status 		= stripslashes ($hasil['status']);
		{
	?>
	
    <tr align="center">
    	<td height="19" bgcolor="#EEF2F7"><?php echo $no=$no+1; ?></td>
    	<td align="center" bgcolor="#EEF2F7"><?=$product_id?></td>
    	<td align="center" bgcolor="#EEF2F7"><?=$product_name?></td>
      	<td align="center" bgcolor="#EEF2F7"><?=$cost?></td>
      	<td align="center" bgcolor="#EEF2F7"><?=$margin?></td>
      	<td align="center" bgcolor="#EEF2F7"><?=$price?></td>
      	<td align="center" bgcolor="#EEF2F7"><?=$status?></td>
		<td bgcolor="#EEF2F7"><div align="center">
        <a href="javascript:void(0);"
    onclick="window.open('form-edit-ms-customer.php?mc_id_cust=<?php echo $mc_id_cust; ?>','nama_window_pop_up','height = 400, width = 950, resizable = 0')">Edit</a>
        || <a href="proses-delete-product&product_id=<?=$product_id?>" onclick="return confirm('Apakah Anda akan Menghapus Product = <?=$product_id?>')"> Delete </a></div></td>
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


