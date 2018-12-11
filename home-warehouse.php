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
?> 
  
<html>
<head>
	<title>Corporate Transaction</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
</head>
	
<body>
<table width="1250" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="397" height="115" align="left" bgcolor="#FFFFFF"><img src="image/kop.png" width="273" height="98"/></td>
        <td width="567" align="right" bgcolor="#FFFFFF"><img src="image/wh-head.png" width="619" height="119"></td>
	</tr>
</table>
<table width="1250" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td><hr></td>
	</tr>
</table>


<table width="1250" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr bgcolor="#F8F8FF" height="32">
		<td width="10" height="50" bgcolor="#FFFFFF">&nbsp;</td>
	  <th width="944" align="center" valign="middle" bgcolor="#FFFFFF">
      
                  <ul id="MenuBar1" class="MenuBarHorizontal">
                    <li><a href="home-warehouse.php?page=home-warehouse&user_id=<?=$_SESSION['user_id']?>" title="Home">Home</a></li>
<li><a href="#" title="Data" class="MenuBarItemSubmenu">Transaction</a>
  <ul>
    <li><a href="home-warehouse.php?page=form-view-data-po&user_id=<?=$_SESSION['user_id']?>">Data PO</a></li>
    <li><a href="home-warehouse.php?page=form-view-cetak-invoice&user_id=<?=$_SESSION['user_id']?>">Invoice Print</a></li>
    <li><a href="home-warehouse.php?page=form-view-cetak-fpajak&mu_username=<?=$_SESSION['mu_username']?>">F Pajak Print</a></li>
		<li><a href="home-warehouse.php?page=form-view-cetak-fpajak&mu_username=<?=$_SESSION['mu_username']?>">Input Resi</a></li>
  </ul>
</li>
                    <li><a href="#" title="Laporan" class="MenuBarItemSubmenu">Report</a>
                      <ul>
                        <li><a href="home-warehouse.php?page=form-laporan-po-wh&mu_username=<?=$_SESSION['mu_username']?>">Report PO</a></li>
                        
                      </ul>
                    </li>
                    <li><a href="#" title="Utility" class="MenuBarItemSubmenu">Utility</a>
                      <ul>
												<li><a href="home-warehouse.php?page=form-view-delete-inv-wh&mu_username=<?=$_SESSION['mu_username']?>">Reprint Invoice</a></li>
                        <li><a href="home-warehouse.php?page=form-view-delete-inv-wh&mu_username=<?=$_SESSION['mu_username']?>">Delete Invoice</a></li>
                        <li><a href="home-warehouse.php?page=form-ganti-password&mu_username=<?=$_SESSION['mu_username']?>" title="Change Password">Change Password</a></li>
                      </ul>
                    </li>
                    <li><a href="login/logout.php" title="Log Out">Log Out</a></li>
                  </ul>
                
		</td>
	  <td width="10" bgcolor="#FFFFFF">&nbsp;</td>
	</tr>
</table>
<table width="1250" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr bgcolor="#F8F8FF">
		<td bgcolor="#FFFFFF">&nbsp;</td>
	</tr>
</table>
<table width="1250" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr bgcolor="#F8F8FF">
		<td width="10" bgcolor="#FFFFFF">&nbsp;</td>
		<td rowspan="4" valign="top" bgcolor="#FFFFFF">
			<table width="1228" height="auto" bgcolor="white" border="0" cellspacing="0" cellpadding="0">
				<tr height="36" width="938">
					<td>&nbsp;&nbsp;&nbsp;&nbsp;<font color="#0000FF"><strong><?php echo "Date : ".date("d-M-y");?></strong>&nbsp;&nbsp;&nbsp;&nbsp;Welcome <u><strong> <?=$_SESSION['user_name']?></strong></font></td>
				</tr>
				<tr>
					<td width="938" align="center" valign="top">
						<?php
						$page = (isset($_GET['page']))? $_GET['page'] : "main";
						switch ($page) {
							case 'form-view-data-po' : include "form-view-data-po.php"; break;
							case 'form-view-cetak-invoice' : include "form-view-cetak-invoice.php"; break;
							case 'main' :
							default : include 'about-login-wh.php';	
						}
						?>
					</td>
				</tr>
			</table>
           
		</td>
		<td width="10" bgcolor="#FFFFFF">&nbsp;</td>
	</tr>
</table>

<table width="1250" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr bgcolor="#F8F8FF">
		<td bgcolor="#FFFFFF">&nbsp;</td>
	</tr>
</table>
<table width="1250" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr bgcolor="#B0C4DE">
		<td height="36" colspan="5" bgcolor="#0000FF"><div align="right" style="margin:0 12px 0 0;"><font color="#FFFFFF"><strong>Copyright &copy; 2018. By Marcus Dedy</strong></font><br></div></td>
	</tr>
</table>
<div align="center"></div>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>