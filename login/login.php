<?php
// Sesion Di jalankan
session_start();

$user_id = $_POST['user_id'];
$password = md5($_POST['password']);
$koneksi=mysql_connect("localhost", "root", "cahbagoes");
$db=mysql_select_db("corporate",$koneksi);

$query = "SELECT * FROM master_employee WHERE user_id = '$user_id'";
$hasil = mysql_query($query) or die("Error");
$data  = mysql_fetch_array($hasil);

if ($data['user_id'] && $password==$data['password']){

    // jika sesuai, maka buat session
        $_SESSION['user_id'] = $data['user_id'];
		$_SESSION['user_name'] = $data['user_name'];
        $_SESSION['department'] = $data['department'];
        if($data['department']=="Finance"){
            header("location:../home-finance.php");
        }else if($data['department']=="Buyer"){
            header("location:../home-buyer.php");
        }else if ($data['department']=="Warehouse"){
			header("location:../home-warehouse.php");
		}
}
else{
		?>
		<script language="JavaScript">
			alert('UserID atau Password tidak sesuai. Silahkan diulang kembali!');
			document.location='../index.php';
		</script>
		<?php
    }
?>