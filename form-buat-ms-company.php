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
<title>Create New Company ID</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
<link href="SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
</head>

<body>
<div align="left"><font color="#FFCC00" size="5">
  <strong>Form Create New Company ID</strong></font>
</div>

<form name="form_buat_ms_company_id" action="proses-input-ms-company-id.php" method="post">
  <table width="567" border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td colspan="3" align="left"><table width="532" border="0" align="center" cellpadding="3" cellspacing="0">
      <tbody>
      <td width="153">&nbsp;</td>
        <td width="1">&nbsp;</td>
          <tr>
            <td>Company Id</td>
            <td>:</td>
            <td width="360"><input name="company_id" type="text" required value="" size="10" maxlength="10" />
          </tr>
  <td>&nbsp;</td>
  <tr>
    <td>Company Name</td>
    <td>:</td>
    <td><input name="company_name" type="text" required value="" size="35" maxlength="50" /></td>
  </tr>
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