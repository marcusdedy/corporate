
<?php
include "config.php";
?>

    <h6><font color="orange" size="5"><u>Reprint File PO</u></font>       <u>
    <left></left>
    </u></h6>
<form action="home-buyer.php?page=form-view-reprint-file-po" method="post" name="postform">
  <table width="546" border="0" align="left">
<tr>
  <td width="69">&nbsp;</td>
    <td width="159">Search PO Number</td>
    <td width="304" colspan="2"><input type="text" name="po_number" value="<?php if(isset($_POST['po_number'])){ echo $_POST['po_number']; }?>"/></td>
</tr>

<tr>
  <td align="center" >&nbsp;</td>
    <td align="center" ></td>
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
	
	$po_number=$_POST['po_number'];

	
	if(empty($po_number) ){
		$Tampil=mysql_query("select * from 
							(select a.po_number, a.po_date, a.customer_id, b.customer_name, a.file_name_detail, c.qty, c.total from 
							(select po_number, po_date, customer_id, file_name_detail from purchase_order_header where file_name_detail <> '')a,
							(select customer_id, customer_name from master_customer)b,
							(select po_number, sum(qty) as qty, sum(total) as total from purchase_order_detail group by po_number)c
							where a.po_number = c.po_number and a.customer_id = b.customer_id)a");
		
	}else{
		// create by Marcuz Dedy
		?>
		<?php
		
		$Tampil=mysql_query("select * from 
							(select a.po_number, a.po_date, a.customer_id, b.customer_name, a.file_name_detail, c.qty, c.total from 
							(select po_number, po_date, customer_id, file_name_detail from purchase_order_header where file_name_detail <>'')a,
							(select customer_id, customer_name from master_customer)b,
							(select po_number, sum(qty) as qty, sum(total) as total from purchase_order_detail group by po_number)c
							where a.po_number = c.po_number and a.customer_id = b.customer_id)a where a.po_number like '%$po_number%'");
	}
	
	?>
</p>

<table width="1206" border="0" align="center" cellpadding="0" cellspacing="1">
	<tr bgcolor="#0066FF">
		<th width="5%" height="25"><font color="#FFFFFF">No</font></td>&nbsp;
		<th width="10%"><font color="#FFFFFF">Po Number</font>      
	  	<th width="17%"><font color="#FFFFFF">PO Date</font>      
	  	<th width="23%"><font color="#FFFFFF">Customer ID</font>
      	<th width="10%"><font color="#FFFFFF">Customer Name</font>
      	<th width="10%"><font color="#FFFFFF">Qty</font>
      	<th width="15%"><font color="#FFFFFF">Total</font>     
      	<th width="10%"><font color="#FFFFFF">Action</font></td>&nbsp; 
	</tr>

	<?php
		$no=0;
	
    while (	$hasil = mysql_fetch_array ($Tampil)) {
			$po_number 		= stripslashes ($hasil['po_number']);
			$po_date		= stripslashes ($hasil['po_date']);
			$customer_id 	= stripslashes ($hasil['customer_id']);
			$customer_name 	= stripslashes ($hasil['customer_name']);
			$qty 			= stripslashes ($hasil['qty']);
			$total 			= stripslashes ($hasil['total']);
			$file_name_detail= stripcslashes($hasil['file_name_detail']);
		{
	?>
	
    <tr align="center">
    	<td height="19" bgcolor="#EEF2F7"><?php echo $no=$no+1; ?></td>
    	<td align="center" bgcolor="#EEF2F7"><?=$po_number?></td>
    	<td align="center" bgcolor="#EEF2F7"><?=$po_date?></td>
      	<td align="center" bgcolor="#EEF2F7"><?=$customer_id?></td>
      	<td align="center" bgcolor="#EEF2F7"><?=$customer_name?></td>
      	<td align="center" bgcolor="#EEF2F7"><?=$qty?></td>
      	<td align="center" bgcolor="#EEF2F7"><?=number_format($total,0,',',',')?></td>
		<td bgcolor="#EEF2F7"><div align="center">
        <a href=files\po\<?=$file_name_detail?>  target="_blank" >Print / Download</a></div></td>
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


