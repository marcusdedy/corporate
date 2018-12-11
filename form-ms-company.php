
<?php
include "config.php";
?>

    <h6><font color="orange" size="5"><u>MS Company</u></font>       <u>
    <left></left>
    </u></h6>
<form action="home-buyer.php?page=form-ms-company" method="post" name="postform">
  <table width="546" border="0" align="left">
<tr>
  <td width="69">&nbsp;</td>
    <td width="159">Search</td>
    <td width="304" colspan="2"><input type="text" name="company_name" value="<?php if(isset($_POST['company_name'])){ echo $_POST['company_name']; }?>"/></td>
</tr>

<tr>
  <td align="center" >&nbsp;</td>
    <td align="center" ><a href="javascript:void(0);"
    onclick="window.open('form-buat-ms-company.php','nama_window_pop_up','height = 230, width = 580, resizable = 0')">++ New Company ID</a></td>
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
	
	$mc_customer_ncompany_nameame=$_POST['company_name'];

	
	if(empty($company_name) ){
		$Tampil=mysql_query("select * from master_company");
		$jumlah=mysql_fetch_array(mysql_query("select count(company_name)total from master_company"));
		
	}else{
		// create by Marcuz Dedy
		?>
		<?php
		
		$Tampil=mysql_query("select * from master_company where company_name like '%$company_name%'");
		$jumlah=mysql_fetch_array(mysql_query("select count(company_name)total from master_company where company_name like '%$company_name%'"));
	}
	
	?>
</p>

<table width="1206" border="0" align="center" cellpadding="0" cellspacing="1">
	<tr bgcolor="#0066FF">
	<th width="5%"><font color="#FFFFFF">No</font></td>&nbsp;
	<th width="15%"><font color="#FFFFFF">Company Id </font>     
	<th width="40%"><font color="#FFFFFF">Company Name   </font>   
	<th width="25%" height="25"><font color="#FFFFFF">Date Create   </font>
    <th width="15%"><font color="#FFFFFF">Action</font></td>&nbsp; 
</tr>
	<?php
$no=0;
	
    while (	$hasil = mysql_fetch_array ($Tampil)) {
			$company_id 		= stripslashes ($hasil['company_id']);
			$company_name	    = stripslashes ($hasil['company_name']);
			$update_date        = stripslashes ($hasil['update_date']);
		{
	
?>
	
    <tr align="center">
    	<td height="19" bgcolor="#EEF2F7"><?php echo $no=$no+1; ?></td>
    	<td align="center" bgcolor="#EEF2F7"><?=$company_id?></td>
    	<td align="center" bgcolor="#EEF2F7"><?=$company_name?></td>
        <td align="center" bgcolor="#EEF2F7"><?=$update_date?><div align="center"></div></td>
		<td bgcolor="#EEF2F7"><div align="center">
        <a href="javascript:void(0);"
    onclick="window.open('form-edit-ms-customer.php?mc_id_cust=<?php echo $mc_id_cust; ?>','nama_window_pop_up','height = 400, width = 950, resizable = 0')">Edit</a>
        || <a href="home-buyer.php?page=proses-delete-ms-company&company_id=<?=$company_id?>">Delete</a></div></td>
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


