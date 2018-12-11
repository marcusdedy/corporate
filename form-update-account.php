

<?php 
include('config.php');
?>

<html>
<head>
<title>Update User</title>
</head>

<body>
<h1><em><strong>Update Your Account</strong></em></h1>

<?php 
$id = $_SESSION['user_id'];

$query = mysql_query("select * from master_employee where user_id='$id'") or die(mysql_error());

$data = mysql_fetch_array($query);
?>

<form name="update_data_account" action="proses-update-account.php" method="post">
<input type="hidden" name="edit_account" value="<?php echo $id; ?>" />
<table border="0" cellpadding="5" cellspacing="0">
    <tbody>
    	<tr>
        	<td>UserID</td>
        	<td>:</td>
        	<td><input type="text" name="user_id" maxlength="20" required value="<?php echo $_SESSION['user_id'];?>" disabled /></td>
        </tr>
        <tr>
            <td>User Name</td>
            <td>:</td>
            <td><input type="text" name="user_name" maxlength="20" required value="<?php echo $_SESSION['user_name'];?>" /></td>
        </tr>
    	<tr>
        	<td>Password</td>
        	<td>:</td>
        	<td><input type="password" name="password" maxlength="20" required value="" /></td>
        </tr>
        <tr>
        	<td align="right" colspan="3"><input type="submit" name="submit"  value="Save" /></td>
        </tr>
    </tbody>
</table>
</form>

</body>
</html>