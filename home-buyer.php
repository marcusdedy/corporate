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
<html>  
<head>
	<title>Corporate Transaction</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
	<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
	<script type="text/javascript">
	function MM_popupMsg(msg) { //v1.0
	  alert(msg);
	}
	function MM_openBrWindow(theURL,winName,features) { //v2.0
	  window.open(theURL,winName,features);
	}
	</script>
        
</head>
<body>
	<table width="1250" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td width="397" height="115" align="left" bgcolor="#FFFFFF"><img src="image/kop.png" width="273" height="98"/></td>
	        <td width="567" align="right" bgcolor="#FFFFFF"><img src="image/head-cust.jpg" width="450" height="112"></td>
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
		<th width="944" height="22" align="center" valign="middle" bgcolor="#FFFFFF">
	    	<ul id="MenuBar1" class="MenuBarHorizontal">
	        	<li><a href="home-buyer.php?page=home-buyer&user_id=<?=$_SESSION['user_id']?>" title="Home">Home</a></li>
	          	<li><a href="#" class="MenuBarItemSubmenu">Master</a>
	            	<ul>
	              		<li><a href="home-buyer.php?page=form-ms-company&user_id=<?=$_SESSION['user_id']?>">Ms Company</a></li>
						<li><a href="home-buyer.php?page=form-ms-customer&user_id=<?=$_SESSION['user_id']?>">Ms Customer</a></li>
						<li><a href="home-buyer.php?page=form-ms-product&user_id=<?=$_SESSION['user_id']?>">Ms Product</a></li>
	            	</ul>
	          	</li>
	          	<li><a href="#" class="MenuBarItemSubmenu">Transaction</a>
	            	<ul>
						<li><a href="javascript:void(0);"
    onclick="window.open('form-input-po.php','nama_window_pop_up','height = 600, width = 800, top = 50, left = 50, resizable = 0')">Input PO </a></li>
						<li><a href="home-buyer.php?page=form-view-upload-file-po&user_id=<?=$_SESSION['user_id']?>">Upload File PO</a></li>
	            	</ul>
	          	</li>
	          	<li><a href="#" class="MenuBarItemSubmenu">Report</a>
	            	<ul>
	              		<li><a href="home-customer.php?page=form-laporan-po-cust&mu_username=<?=$_SESSION['mu_username']?>">Report PO</a></li>
	            	</ul>
	          	</li>
	          	<li><a href="#" title="Utility" class="MenuBarItemSubmenu">Utility</a>
	            	<ul>
	            		<li><a href="home-buyer.php?page=form-view-reprint-file-po&user_id=<?=$_SESSION['user_id']?>">Reprint File PO</a></li>
	              		<li><a href="home-buyer.php?page=form-view-delete-po&user_id=<?=$_SESSION['user_id']?>">Delete PO</a></li>
	              		<li><a href="home-buyer.php?page=form-update-account&user_id=<?=$_SESSION['user_id']?>" title="Change Account">Account</a></li>
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
						<td>&nbsp;&nbsp;&nbsp;&nbsp;<font color="#0000FF"><strong><?php echo "Date : ".date("d-M-y");?></strong>&nbsp;&nbsp;&nbsp;&nbsp; Welcome <u><strong> <?=$_SESSION['user_name']?></strong></u></font></td>
					</tr>
					<tr>
						<td width="938" align="center" valign="middle">
							<?php
								$page = (isset($_GET['page']))? $_GET['page'] : "main";
								switch ($page)
								{
									case 'form-ms-company' : include "form-ms-company.php"; break;
									case 'form-ms-customer' : include "form-ms-customer.php"; break;
									case 'form-ms-product' : include "form-ms-product.php"; break;
									case 'form-view-upload-file-po' : include "form-view-upload-file-po.php"; break;
									case 'form-view-reprint-file-po' : include "form-view-reprint-file-po.php"; break;
									case 'form-view-delete-po' : include "form-view-delete-po.php"; break;
									case 'proses-delete-po' : include "proses-delete-po.php"; break;
									case 'form-update-account' : include "form-update-account.php"; break;
									case 'main' :
									default : include 'about-login-buyer.php';	
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
			<td width="1106" bgcolor="#FFFFFF">&nbsp;</td>
		</tr>
	</table>

	<table width="1250" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr bgcolor="#B0C4DE">
			<td width="1101" height="36" colspan="5" bgcolor="#0000FF"><div align="right" style="margin:0 12px 0 0;"><font color="#FFFFFF"><strong>Copyright &copy; 2018. By Marcus Dedy</strong></font><br></div></td>
		</tr>
	</table>
	
	<div align="center"></div>
	<script type="text/javascript">
	var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
	</script>
</body>
</div>
</html>