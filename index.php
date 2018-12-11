<?php
ob_start();
session_start();
?>

<html>
<head>
	<title>Corporate Transaction</title>
	<link href="style.css" rel="stylesheet" type="text/css">

	
	<style type="text/css">


	/* style untuk link popup */
	a.popup-link {
		padding:17px 0;
		text-align: center;
		margin:7% auto;
		position: relative;
		width: 300px;
		color: #fff;
		text-decoration: none;
		background-color: #005ca8;
		border-radius: 3px;
		box-shadow: 0 5px 0px 0px #eea900;
		display: block;
	}
	a.popup-link:hover {
		background-color: #ff9900;
		box-shadow: 0 3px 0px 0px #eea900;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}
	/* end link popup*/

	/*style untuk popup */	
	#popup {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup:target {
		visibility:visible;
		opacity: 1;
		background-color: rgba(0,0,0,0.8);
		position: fixed;
		top:0;
		left:0;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}

	@media (min-width: 768px){
		.popup-container {
			width:600px;
		}
	}
	@media (max-width: 767px){
		.popup-container {
			width:100%;
		}
	}
	.popup-container {
		position: relative;
		margin:7% auto;
		padding:30px 50px;
		background-color: #fafafa;
		color:#333;
		border-radius: 3px;
	}

	a.popup-close {
		position: absolute;
		top:3px;
		right:3px;
		background-color: #333;
		padding:7px 10px;
		font-size: 20px;
		text-decoration: none;
		line-height: 1;
		color:#fff;
	}

	/* style untuk isi popup */


	.popup-form {
		margin:10px auto;
	}
		.popup-form h2 {
			margin-bottom: 5px;
			font-size: 37px;
			text-transform: uppercase;
		}
		.popup-form .input-group {
			margin:10px auto;
		}
			.popup-form .input-group input {
				padding:17px;
				text-align: center;
				margin-bottom: 10px;
				border-radius:3px;
				font-size: 16px; 
				display: block;
				width: 100%;
			}
			.popup-form .input-group input:focus {
				outline-color:#FB8833; 
			}
			.popup-form .input-group input[type="email"] {
				border:0px;
				position: relative;
			}
			.popup-form .input-group input[type="submit"] {
				background-color: #c72127;
				color: #fff;
				border: 0;
				cursor: pointer;
			}
			.popup-form .input-group input[type="submit"]:focus {
				box-shadow: inset 0 3px 7px 3px #ea7722;
			}

	</style>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<table width="1250" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		
        <td width="964" align="center" bgcolor="#FFFFFF">
        <img src="image/head-frontpage-2.png" width="1249" height="102" />
        </td>
  </tr>
</table>
<table width="1250" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td><hr></td>
	</tr>
</table>
<table width="1250" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr bgcolor="#F8F8FF" height="32">
		<td width="10" bgcolor="#FFFFFF">&nbsp;</td>
		<td width="944">
			<div class="nav">
				<ul>
		  <li><a href="index.php?page=home" title="Home"><u>H</u>ome</a></li>
					<li><a href="#popup" title="Login"><u>L</u>ogin</a></li>
				</li>
			
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
				<tr>
					<td width="938" align="center" valign="top">
						<?php
						$page = (isset($_GET['page']))? $_GET['page'] : "main";
						switch ($page) {
							case 'login' : include "login/login.php"; break;
							case 'main' :
							default : include 'home.php'
							;	
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
</body>
</html>
<div align="center"></div>
<div class="popup-wrapper" id="popup">
	<div class="popup-container">
    <form action="login/login.php" method="post" class="popup-form">
			<font color="#0000FF"><h2>Login Your Authorization:</h2></font>
			<div class="input-group">
			<input type="text" name="user_id" placeholder=" UserID" required autofocus size="21" maxlength="20" /><br />
			<input type="password" name="password" placeholder=" Password" size="21" maxlength="20" /><br /><br />
			<input type="submit" value="Login">
				</p>
			</div>
			<a class="popup-close" href="#closed">X</a>
	</form>
</div>
</div>
