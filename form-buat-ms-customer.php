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
<title>Create New Customer</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
<link href="SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
</head>

<body>
<center>
<font color="#FFCC00" size="5">
<strong>Form Create New Customer</strong></font>
</center>

<form name="form_buat_ms_customer" action="proses-input-ms-customer.php" method="post">
<table width="909" border="0" align="center" cellpadding="5" cellspacing="0">
    <tbody>
        <tr>
        	<td width="160" height="25">Customer ID</td>
        	<td width="13">:</td>
        	<td width="761"><input name="customer_id" type="text" required value="" size="8" maxlength="10" /></td>
        </tr>
        <tr>
            <td height="36">Customer Name</td>
            <td>:</td>
            <td><input name="customer_name" type="text" required value="" size="50" maxlength="100" /></td>
        </tr>
        <tr>
            <td height="31">Address</td>
            <td>:</td>
            <td><textarea name="customer_address" cols="75" required></textarea></td>
        </tr>
        <tr>
            <td height="35">Phone</td>
            <td>:</td>
            <td><input name="phone_number" type="text" required value="" size="20" maxlength="20" /></td>
        </tr>
        <tr>
          <td height="36">Company Id</td>
          <td>:</td>
          <td>
            <select name="company_id" >
        <?php
            include "config.php";
            $query = "SELECT * from master_company order by company_id asc";
            $hasil = mysql_query($query);
            while ($qtabel = mysql_fetch_assoc($hasil))
            {
                echo '<option value="'.$qtabel['company_id'].'">'.$qtabel['company_id'].'</option>';               
            }
            ?>
        </select>
        </tr>
        <tr>
        	<td height="32">UP</td>
        	<td>:</td>
        	<td><input name="for_attention" type="text" required value="" size="25" maxlength="25" /></td>
        </tr>
        <tr>
        	<td height="32">User</td>
        	<td>:</td>
        	<td><input name="user_update" type="text" required value="<?php echo $_SESSION['user_id'];?>" size="15" maxlength="25" readonly /></td>
  <tr>
    <td height="49" colspan="3" align="left"><input type="submit" class="btn btn-info" name="submit" value="Save" />
      <input type="submit" class="btn btn-danger" name="submit2" value="Cancel" onClick="window.close();"/></td>
  </tr>
    </tbody>

</table>

</form>
</body>
</html>