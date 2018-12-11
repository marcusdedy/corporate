<?php
include('config.php');

//tangkap data dari form
$id 			= $_POST['edit_account'];
$user_name		= $_POST['user_name'];
$password 		= md5($_POST['password']);
$update_date	= DATE("Y-m-d h:i:sa");

//validasi data jika data kosong
	if (empty($_POST['user_name'])) {
	?>
		<script language="JavaScript">
		alert('Error.');
		window.close();
		</script>
	<?php
	}
	else {
	//Masukan data ke Table bayar
	$update	="update master_employee set password='$password', user_name ='$user_name', update_date = '$update_date' where user_id='$id' ";
	$query_update =mysql_query($update);

		if ($query_update) {
		//Jika Sukses
	?>
		<script language="JavaScript">
		alert('Successfully Change Password !!! Please login again');
		document.location='login/logout.php';
		</script>
	<?php
	}
	else {
	//Jika Gagal
	echo "Gagal Diinput, Silahkan diulangi!";
	}
	}
	//Tutup koneksi engine MySQL

?>
</body>