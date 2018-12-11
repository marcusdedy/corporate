<?php 
    session_start();
    $department = $_SESSION['department'];
    if(!isset($_SESSION['user_id']) && $department!="Warehouse"){
    ?>
      <script language="JavaScript">
        alert('Anda Harus Login. Silahkan Login kembali!');
        document.location='index.php';
      </script>
    <?php
    }
?><head>
        <title>Invoice Print</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
      </head>

  <?php
			require 'lib/function-invoice.php';
			$fungsi = new Fungsi();?>
  
       <h6>
 <div align="center"><font color="orange" size="5"><u>Print Invoice</u></font>
 </div>
 <p>
  <?php
	include "config.php";
	if (isset($_GET['faktur'])) {
		$faktur = $_GET['faktur'];
	}
	else {
	die ("Error. No Data Selected! ");	
	}
        	$query = "select a.po_number, a.po_date, a.customer_id, b.customer_name, c.company_name, b.for_attention, a.po_noted, d.faktur, d.date_faktur, d.tot_qty, 
        d.tot_price as subtotal, sum(d.tot_price*0.1)ppn, sum((d.tot_price*0.1)+d.tot_price) as total from
        (select po_number, po_date, customer_id, po_noted from purchase_order_header)a,
        (select customer_id, company_id, customer_name, for_attention from master_customer)b,
        (select company_id, company_name from master_company)c,
        (select faktur, date_faktur, po_number, tot_qty, tot_price from faktur_jual)d
        where a.customer_id = b.customer_id and a.po_number = d.po_number 
        and b.company_id = c.company_id and d.faktur = '$faktur'
        group by a.po_number, a.po_date, a.customer_id, b.customer_name, c.company_name, b.for_attention, a.po_noted, d.faktur, d.date_faktur, d.tot_qty, d.tot_price";

	$sql          = mysql_query ($query);
	$hasil        = mysql_fetch_array ($sql);
	$po_number	  = $hasil['po_number'];
	$po_date	    = $hasil['po_date'];
	$customer_id	= $hasil['customer_id'];
	$customer_name= $hasil['customer_name'];
  $company_name = $hasil['company_name'];
  $for_attention= $hasil['for_attention'];
	$po_noted	    = $hasil['po_noted'];
	$faktur	      = $hasil['faktur'];
	$date_faktur	= $hasil['date_faktur'];
  $tot_qty      = $hasil['tot_qty'];
  $subtotal     = $hasil['subtotal'];
  $ppn          = $hasil['ppn'];
  $total        = $hasil['total'];

?>
</p>
<form action="cetak-oo-invoice.php" method="POST" name="form_cetak_invoice" id ="form_cetak_invoice">
  <table width="932" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr height="20">
		<td width="139" height="22"><strong>Invoice Number</strong></td>
		<td width="11"><strong>:</strong></td>
   	<td width="782"><input name="cih_invoice_reff" type="text"  value="<?php echo $fungsi->KwNums()?>" size="25" readonly="readonly" /> 
   	Faktur : 
   	  <input name="faktur" type="text"  value="<?=$faktur?>" size="25" readonly="readonly" />
    </td>
  <tr height="20">
    <td height="29"><strong>Customer</strong></td>
    <td><strong>:</strong></td>
    <td><input name="customer_id" type="text"  value="<?=$customer_id?>" size="5" readonly="readonly" />
   	      <input name="customer_name" type="text"  value="<?=$customer_name?>" size="50" readonly="readonly" /> 
   	      up: 
   	      <input name="for_attention" type="text"  value="<?=$for_attention?>" size="25" readonly="readonly" /></td>
  	  </tr>
                                
                     <tr>
                       <td height="33" bgcolor="#FFFFFF">&nbsp;</td>
                       <td bgcolor="#FFFFFF">&nbsp;</td>
                       <td bgcolor="#FFFFFF"><input name="company_name" type="text"  value="<?=$company_name?>" size="50" readonly="readonly" /></td>
                     </tr>
                     <tr>
  <td width="139" height="33" bgcolor="#FFFFFF"><strong>Total Rp.</strong></td>
  <td bgcolor="#FFFFFF"><strong>:</strong></td>
  <td bgcolor="#FFFFFF"><input name="sub_total" type="text"  value="<?=$subtotal?>" size="10" align="right" readonly="readonly" /></td>
</tr>
<tr>
<td height="25" bgcolor="#FFFFFF"><strong>PPn</strong></td>
<td valign="middle" bgcolor="#FFFFFF"><strong>:</strong></td>
<td valign="middle" bgcolor="#FFFFFF">
  <input name="ppn" id="ppn" value="<?=$ppn?>" size="10" maxlength="25" align="right" readonly="readonly" /></td>
</tr>

<tr>
<td height="29" bgcolor="#FFFFFF"><strong>Total Invoice</strong></td>
<td bgcolor="#FFFFFF"><strong>:</strong></td>
<td bgcolor="#FFFFFF"><input name="total" value="<?=$total?>" size="10" align="right" readonly="readonly" /></td>
</tr>
                    
    <tr height="20">
      <td height="22"><strong>Noted</strong></td>
      <td><strong>:</strong></td>
      <td><input name="invoice_noted" type="text"  value="" size="70" maxlength="225" /></td>
    </tr>
    <tr height="20">
             <td width="139" height="33"><strong>User</strong></td>
             <td width="11"><strong>:</strong></td>
            		<td width="782"><input name="user_print_invoice" type="text"  value=" <?php echo $_SESSION['user_id'] ?>" size="20" readonly="readonly" />
    </td></tr>

		<tr>
			<td><strong>Mgr</strong></td>
			<td><strong>:</strong></td>
		  <td height="22"><?php  
mysql_connect("localhost","root","cahbagoes");  
mysql_select_db("corporate");  
$result = mysql_query("select * from master_employee where position = 'Manager'");  
$jsArray = "var prdName = new Array();\n";  
echo '<select user_name="prdId" onchange="changeValue(this.value)">';  
echo '<option>-------</option>';  
while ($row = mysql_fetch_array($result)) {  
    echo '<option value="' . $row['user_name'] . '">' . $row['user_name'] . '</option>';  
    $jsArray .= "prdName['" . $row['user_name'] . "'] = {user_name:'" . addslashes($row['user_name']) . "',position:'".addslashes($row['position'])."', user_id:'" . addslashes($row['user_id']) . "'};\n";  
}  
echo '</select>';  
?>  <input name="user_id_approve" size="8" type="text" id="user_id" readonly="readonly"/>
			  
			  <input name="user_name" type="text" size="20" id="user_name" readonly="readonly"/>
			  <input name="position" type="text" size="10" id="position" readonly="readonly"/>
	      <script type="text/javascript">  
<?php echo $jsArray; ?>
function changeValue(id){
document.getElementById('user_id').value = prdName[id].user_id;
document.getElementById('user_name').value = prdName[id].user_name;
document.getElementById('position').value = prdName[id].position;
};
</script></td>
</tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td height="22">&nbsp;</td>
    </tr>
		<tr>
        <td colspan="3" align="left"><input type="submit" class="btn btn-info" name="submit" value="Save & Print" />
          <input type="submit" class="btn btn-danger" name="submit2" value="Cancel" onClick="window.close();"/></td>
      </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td height="22">&nbsp;</td>
    </tr>
  </table>
  <table width="736" border="0" align="center" cellpadding="0" cellspacing="1">
    <tr bgcolor="#0066CC">
      <td width="2%" align="left"><strong><font color="#FFFFFF">No</font></strong></td>
        &nbsp;
        <td width="23%" align="center"><strong><font color="#FFFFFF">PO Number</font></strong></td>
        &nbsp;
        <td width="7%" align="center"><strong><font color="#FFFFFF">ProdID</font></strong></td>
        &nbsp;
         <td width="25%" align="center"><strong><font color="#FFFFFF">Product Name</font></strong></td>
        &nbsp;
         <td width="10%" align="center"><strong><font color="#FFFFFF">Qty</font></strong></td>
        &nbsp;
         <td width="15%" align="center"><strong><font color="#FFFFFF">Price</font></strong></td>
        &nbsp;
        <td width="25%" align="center"><strong><font color="#FFFFFF">Total</font></strong></td>
        &nbsp;

    </tr>
      <tbody>
        <?php
	include "config.php";
	$Cari= "select a.po_number, a.product_id, b.product_name, a.qty, b.price, a.total from 
          (select po_number, product_id, qty, total from purchase_order_detail)a,
          (select product_id, product_name, price from master_product)b,
          (select faktur, po_number from faktur_jual where faktur = '$faktur')c
          where a.po_number = c.po_number and a.product_id = b.product_id";

	$jumlah= mysql_fetch_array(mysql_query(" select sum( a.total) as subtotal from 
          (select po_number, product_id, qty, total from purchase_order_detail)a,
          (select product_id, product_name, price from master_product)b,
          (select faktur, po_number from faktur_jual where faktur = '$faktur')c
          where a.po_number = c.po_number and a.product_id = b.product_id"));

	$Tampil = mysql_query($Cari);
	
	$nomer=0;
    while (	$hasil	= mysql_fetch_array ($Tampil)) {
			$po_number		= stripslashes ($hasil['po_number']);
			$product_id		= stripslashes ($hasil['product_id']);
      $product_name = stripslashes ($hasil['product_name']);
			$qty	        = stripslashes ($hasil['qty']);
			$total			  = stripslashes ($hasil['total']);
			$price			  = stripslashes ($hasil['price']);

		{
	$nomer++;
?>
        <tr align="center">
          <td align="center"><?=$nomer?>
          <div align="center"></div></td>
          <td align="center" ><?=$po_number?></td>
          <td align="center" ><?=$product_id?></td>
          <td align="left" ><?=$product_name?></td>
          <td align="center"><?=$qty?></td>
          <td align="right" ><?=number_format($price,0,',','.')?></td>
          <td align="right" ><?=number_format($total,0,',','.')?></td>
          <div align="center"></div></td>
        </tr>
        <?php  
		}
	}
?>
        <tr align="center" bgcolor="#DFE6EF">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="6" align="right"><strong>GRAND TOTAL </strong></td>
          <td align="right"><?php echo number_format($jumlah['subtotal'],0,',','.');?></td>
        </tr>
      </tbody>
      
</table>
<p>&nbsp;  </p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</form>


