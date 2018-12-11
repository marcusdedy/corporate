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
include('config.php');
?>
 
<html>
<head>
<title>Create New Product</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
<link href="SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
</head>

<!-- buat menghitung price -->

<script type="text/javascript">
  function startCalculate(){
    marcusmenghitung=setInterval("Calculate()",2);
  }
  function Calculate(){
    var a=document.form_buat_ms_product.cost.value;
    var b=document.form_buat_ms_product.margin.value;
    var c=document.form_buat_ms_product.price.value= (a*1)+(b*1);
  }
  function stopCalc(){
    clearInterval(marcusmenghitung);
  }
</script>



<body>
<div align="center"><font color="#FFCC00" size="5">
  <strong>	Form Create New Product</strong></font>
</div>

<form name="form_buat_ms_product" action="proses-input-ms-product.php" method="post">
  <table width="567" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td colspan="3" align="left"><table width="632" border="0" align="center" cellpadding="3" cellspacing="0">
      <tbody>
      <td width="153">&nbsp;</td>
        <td width="1">&nbsp;</td>
          <tr>
            <td>Product Id</td>
            <td>:</td>
            <td width="360"><input name="product_id" type="text" required value="" size="10" maxlength="10" />
          </tr>
            <td>&nbsp;</td>
          <tr>
            <td>Product Name</td>
            <td>:</td>
            <td><input name="product_name" type="text" required value="" size="50" maxlength="50" /></td>
          </tr>
              <td>&nbsp;</td>
          <tr>
            <td>Cost</td>
            <td>:</td>
            <td><input name="cost" type="number" required value="" size="10" maxlength="25" style="text-align:right" onFocus="startCalculate()" onBlur="stopCalc()" /></td>
          </tr>
                      <td>&nbsp;</td>
          <tr>
            <td>Margin</td>
            <td>:</td>
            <td><input name="margin" type="number" required value="" size="10" maxlength="25" style="text-align:right" onFocus="startCalculate()" onBlur="stopCalc()" /></td>
          </tr>
              <td>&nbsp;</td>
          <tr>
            <td>Price</td>
            <td>:</td>
            <td><input name="price" id="price" type="number" required value="" size="10" maxlength="25" style="text-align:right" onfocus="startCalculate()" onblur="stopCalc()" size="25" readonly="readonly" /></td>
          </tr>
          <td>&nbsp;</td>
          <tr>
            <td>Status Aktif</td>
            <td>:</td>
            <td width="360"><input name="status" type="checkbox" id="status" value="T" 
              <?php if (!(strcmp("","T"))) {
                  echo "checked=\"checked\"";} ?>>
          
          </tr>
          <td>&nbsp;</td>
          <tr>
          <td>User</td>
          <td>:</td>
          <td><input name="user_update" type="text" required value="<?php echo $_SESSION['user_id'];?>" size="15" maxlength="25" readonly /></td>
  <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
      <tr>
        <td colspan="3" align="left"><input type="submit" class="btn btn-info" name="submit" value="Save" />
          <input type="submit" class="btn btn-danger" name="submit2" value="Cancel" onClick="window.close();"/></td>
      </tr>
    </table></td>
  </tr>
  </table>
</form>
</body>
</html>