
<?php
include "config.php";
?>

    <h6><font color="orange" size="5"><u>Invoice Print</u></font>       <u>
    <left></left>
    </u></h6>
<form action="home-warehouse.php?page=form-view-cetak-invoice" method="post" name="postform">
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
        (select a.po_number, date_format(a.po_date, '%d %M %Y') as po_date, a.customer_id, b.customer_name, c.faktur, date_format(c.date_faktur, '%d %M %Y') as date_faktur, c.tot_qty, c.tot_price from 
        (select po_number, po_date, customer_id, file_name_detail from purchase_order_header where po_number in (select po_number from faktur_jual where faktur not in (select faktur from invoice)) )a,
        (select customer_id, customer_name from master_customer)b,
        (select po_number, faktur, date_faktur, tot_qty, tot_price from faktur_jual)c
        where a.po_number = c.po_number and a.customer_id = b.customer_id)a");
		
	}else{
		// create by Marcuz Dedy
		?>
		<?php
		
		$Tampil=mysql_query("select * from 
        (select a.po_number, date_format(a.po_date, '%d %M %Y') as po_date, a.customer_id, b.customer_name, c.faktur, date_format(c.date_faktur, '%d %M %Y') as date_faktur, c.tot_qty, c.tot_price from 
        (select po_number, po_date, customer_id, file_name_detail from purchase_order_header where po_number in (select po_number from faktur_jual where faktur not in (select faktur from invoice)) )a,
        (select customer_id, customer_name from master_customer)b,
        (select po_number, faktur, date_faktur, tot_qty, tot_price from faktur_jual)c
        where a.po_number = c.po_number and a.customer_id = b.customer_id)a where a.po_number like '%$po_number%'");
	}
	
	?>
</p>

<table width="1206" border="0" align="center" cellpadding="0" cellspacing="1">
	<tr bgcolor="#0066FF">
		<th width="5%" height="25"><font color="#FFFFFF">No</font></td>&nbsp;
		<th width="13%"><font color="#FFFFFF">Po Number</font>      
	  <th width="10%"><font color="#FFFFFF">PO Date</font>      
	  <th width="10%"><font color="#FFFFFF">Customer ID</font>
    <th width="15%"><font color="#FFFFFF">Customer Name</font>
    <th width="13%"><font color="#FFFFFF">Faktur</font>
    <th width="10%"><font color="#FFFFFF">Faktur Date</font>
    <th width="7%"><font color="#FFFFFF">Total Qty</font>
    <th width="7%"><font color="#FFFFFF">Total Price</font>     
    <th width="10%"><font color="#FFFFFF">Action</font></td>&nbsp; 
	</tr>

	<?php
		$no=0;
	
    while (	$hasil     = mysql_fetch_array ($Tampil)) {
			$po_number       = stripslashes ($hasil['po_number']);
			$po_date		     = stripslashes ($hasil['po_date']);
			$customer_id 	   = stripslashes ($hasil['customer_id']);
      $customer_name 	 = stripslashes ($hasil['customer_name']);
      $faktur          = stripslashes ($hasil['faktur']);
      $date_faktur     = stripslashes ($hasil['date_faktur']);
			$tot_qty	       = stripslashes ($hasil['tot_qty']);
			$tot_price	     = stripslashes ($hasil['tot_price']);
		{
	?>
	
    <tr align="center">
    	<td height="19" bgcolor="#EEF2F7"><?php echo $no=$no+1; ?></td>
    	<td align="center" bgcolor="#EEF2F7"><?=$po_number?></td>
    	<td align="center" bgcolor="#EEF2F7"><?=$po_date?></td>
      <td align="center" bgcolor="#EEF2F7"><?=$customer_id?></td>
      <td align="left"   bgcolor="#EEF2F7"><?=$customer_name?></td>
      <td align="center" bgcolor="#EEF2F7"><?=$faktur?></td>
      <td align="center" bgcolor="#EEF2F7"><?=$date_faktur?></td>
      <td align="center" bgcolor="#EEF2F7"><?=$tot_qty?></td>
      <td align="center" bgcolor="#EEF2F7"><?=number_format($tot_price,0,',',',')?></td>
		  <td bgcolor="#EEF2F7"><div align="center">
         <a href="javascript:void(0);"
            onclick="window.open('form-cetak-invoice.php?faktur=<?php echo $faktur; ?>','nama_window_pop_up','height = 550, width = 900, top = 50, left = 50, resizable = 0')"> Print Invoice </a>
        </div></td>
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