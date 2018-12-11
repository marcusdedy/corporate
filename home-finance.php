<?php 
    session_start();
    $department = $_SESSION['department'];
    if(!isset($_SESSION['user_id']) && $department!="Finance"){
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
	        <td width="567" align="right" bgcolor="#FFFFFF">
	        <img src="image/head-fin.png" width="643" height="106" /></td>
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
			<ul id="MenuBar2" class="MenuBarHorizontal">
		        <li><a href="home-finance.php?page=home-finance&user_id=<?=$_SESSION['user_id']?>" title="Home">Home</a></li>
		        <li><a href="#" title="Ms Customer" class="MenuBarItemSubmenu">Master</a>
		        	<ul>
		                <li><a href="home-finance.php?page=form-ms-user&user_id=<?=$_SESSION['user_id']?>">MS User</a></li>
		            </ul>
		        </li>
		        <li><a href="#" title="Buat Baru" class="MenuBarItemSubmenu">Transaction</a>
		            <ul>
		              	<li><a href="home-finance.php?page=proses-uploads-fpajak&mu_username=<?=$_SESSION['mu_username']?>">Upload F.Pajak</a></li>
						<li><a href="home-finance.php?page=proses-uploads-fpajak&mu_username=<?=$_SESSION['mu_username']?>">Payment</a></li>
		              	<li><a href="home-finance.php?page=form-view-monitoring-po&mu_username=<?=$_SESSION['mu_username']?>">Monitoring PO</a></li>
		            </ul> 
		        </li>
				<li><a href="#" title="Laporan" class="MenuBarItemSubmenu">Report</a>
		  			<ul>
		    			<li><a href="home-finance.php?page=form-laporan-po-fin&mu_username=<?=$_SESSION['mu_username']?>">Report PO</a></li>
		    			<li><a href="home-finance.php?page=form-laporan-inv-fin&mu_username=<?=$_SESSION['mu_username']?>">Report Invoice</a></li>
		  			</ul>
				</li>
		        <li><a href="#" title="Utility" class="MenuBarItemSubmenu">Utility</a>
		            <ul>
		                <li><a href="#" class="MenuBarItemSubmenu">Reprint</a>
		                   	<ul>
		                    	<li><a href="home-finance.php?page=form-view-cetak-ulang-po-fin&mu_username=<?=$_SESSION['mu_username']?>">Reprint TAX</a></li>
		                        <li><a href="home-finance.php?page=form-view-cetak-ulang-fin&mu_username=<?=$_SESSION['mu_username']?>">Reprint Invoice</a></li>
		                    </ul>
		                </li>
		                <li><a href="home-finance.php?page=form-ganti-password&mu_username=<?=$_SESSION['mu_username']?>" title="Change Password">Change Password</a></li>
		            </ul> 
		        </li>
		        <li><a href="login/logout.php" title="Log Out">Log Out</a></li>
		    </ul>
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
								switch ($page) 
								{
									case 'form-ms-user' : include "form-ms-user.php"; break;
									case 'form-buat-ms-user' : include "form-buat-ms-user.php"; break;
									case 'proses-input-ms-user' : include "proses-input-ms-user.php"; break;
									case 'proses-hapus-ms-user' : include "proses-hapus-ms-user.php"; break;
									case 'form-view-cetak-invoice-fin' : include "form-view-cetak-invoice-fin.php"; break;
									case 'form-cetak-invoice' : include "form-cetak-invoice.php"; break;
									case 'proses-uploads-fpajak' : include "proses-uploads-fpajak.php"; break;
									case 'proses-upload-fpajak-temp' : include "proses-upload-fpajak-temp.php"; break;
									case 'proses-update-fpajak-temp' : include "proses-update-fpajak-temp.php"; break;
									case 'proses-delete-fpajak-temp' : include "proses-delete-fpajak-temp.php"; break;
									case 'form-view-upload-fpajak' : include "form-upload-fpajak.php"; break;
									case 'form-view-input-pembayaran' : include "form-view-input-pembayaran.php"; break;
									case 'form-input-pembayaran' : include "form-input-pembayaran.php"; break;
									case 'proses-input-pembayaran' : include "proses-input-pembayaran.php"; break;
									case 'form-view-monitoring-po' : include "form-view-monitoring-po.php"; break;
									case 'form-ganti-password' : include "form-ganti-password.php"; break;
									case 'form-ms-approval' : include "form-ms-approval.php"; break;
									case 'form-buat-ms-approval' : include "form-buat-ms-approval.php"; break;
									case 'proses-input-ms-approval' : include "proses-input-ms-approval.php"; break;
									case 'proses-hapus-ms-approval' : include "proses-hapus-ms-approval.php"; break;
									case 'form-view-cetak-ulang-fin' : include "form-view-cetak-ulang-fin.php"; break;
									case 'form-laporan-po-fin' : include "form-laporan-po-fin.php"; break;
									case 'form-view-delete-inv-fin' : include "form-view-delete-inv-fin.php"; break;
									case 'form-view-input-pembayaran-po' : include "form-view-input-pembayaran-po.php"; break;
									case 'proses-input-pembayaran-po' : include "proses-input-pembayaran-po.php"; break;
									case 'form-view-cetak-ulang-po-fin' : include "form-view-cetak-ulang-po-fin.php"; break;
									case 'form-laporan-inv-fin' : include "form-laporan-inv-fin.php"; break;
									case 'form-view-fpajak-tidak-ditemukan' : include "form-view-fpajak-tidak-ditemukan.php"; break;
									case 'proses-delete-po-kosong' ; include "proses-delete-po-kosong.php"; break;
									case 'proses-insert-corp-inv-monitoring' ; include "proses-insert-corp-inv-monitoring.php"; break;
									case 'form-view-monitoring-inv-ho' ; include "form-view-monitoring-inv-ho.php"; break;
									case 'proses-update-monitoring-inv-ho' ; include "proses-update-monitoring-inv-ho.php"; break;
									case 'main' :
									default : include 'about-login-finance.php';	
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
			<td height="36" colspan="5" bgcolor="#0000FF"><div align="right" style="margin:0 12px 0 0;"><font color="#FFFFFF"><strong>Copyright &copy; 2017. By Finance Development</strong></font><br></div></td>
		</tr>
	</table>
	<div align="center"></div>
	<script type="text/javascript">
	var MenuBar1 = new Spry.Widget.MenuBar("MenuBar2", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
	</script>
</body>
</html>