<html>
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
  <head>
      <title>Form Input PO</title>
      <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
   </head>



<?php
include_once "config.php";
if($_GET) {
  # HAPUS DAFTAR barang DI TMP
  if(isset($_GET['Act'])){
    if(trim($_GET['Act'])=="Delete"){
      # Hapus Tmp jika datanya sudah dipindah
      mysql_query("DELETE FROM tmp_purchase_order_dtl WHERE id='".$_GET['ID']."' AND user_id='".$_SESSION['user_id']."'", $connect) 
        or die ("Gagal kosongkan tmp".mysql_error());
    }
    if(trim($_GET['Act'])=="Sucsses"){
      echo "<b>DATA BERHASIL DISIMPAN</b> <br><br>";
    }
  }
  // =========================================================================
  
  if($_POST) {
  # TOMBOL PILIH (KODE barang) DIKLIK
  if(isset($_POST['btnPilih'])){
    $message = array();
    if (trim($_POST['txtKode'])=="") {

      $message[] = "Product Not Filled !!!";
    }
    if (trim($_POST['txtJumlah'])=="" OR ! is_numeric(trim($_POST['txtJumlah']))) {
      $message[] = "The number of items (Qty) has not been filled, please fill in the numbers !!!";
    }
    
    # Baca variabel
    $txtKode  = $_POST['txtKode'];
    $txtKode  = str_replace("'","&acute;",$txtKode);
    $txtJumlah  = $_POST['txtJumlah'];
    $txtJumlah  = str_replace("'","&acute;",$txtJumlah);
    
    # Jika jumlah error message tidak ada
    if(count($message)==0){     
      $barangSql ="SELECT * FROM master_product WHERE product_id='$txtKode'";
      $barangQry = mysql_query($barangSql, $connect) or die ("Gagal Query Tmp".mysql_error());
      $barangRow = mysql_fetch_array($barangQry);
      $barangQty = mysql_num_rows($barangQry);
      if ($barangQty > 0 ) {
        
        $price = intval($barangRow['price']);
        $tmpSql = "INSERT INTO tmp_purchase_order_dtl SET product_id='$barangRow[product_id]', price='$price', 
               qty='$txtJumlah', user_id='".$_SESSION['user_id']."'";
        mysql_query($tmpSql, $connect) or die ("Gagal Query detail barang : ".mysql_error());
        $txtKode= "";
        $txtJumlah  = "";
      }
      else {

        
      }
    }

  }
  // ============================================================================
  
  # JIKA TOMBOL SIMPAN DIKLIK
  if(isset($_POST['btnSave'])){
    $message = array();
    if (trim($_POST['po_number'])=="") {
      $message[] = "PO numbers cannot be empty!!!";
    }
    $tmpSql ="SELECT COUNT(*) As qty FROM tmp_purchase_order_dtl WHERE user_id='".$_SESSION['user_id']."'";
    $tmpQry = mysql_query($tmpSql, $connect) or die ("Gagal Query Tmp".mysql_error());
    $tmpRow = mysql_fetch_array($tmpQry);
    if ($tmpRow['qty'] < 1) {

      $message[] = "No item has been entered, at least 1 item !!!";
     
    }
    
    # Baca variabel
    $customer_id= $_POST['customer_id'];
    $po_number = $_POST['po_number'];
    $po_noted = $_POST['po_noted'];
    $po_date =$_POST['po_date'];
    $input_date = DATE("Y-m-d h:i:sa");
        
    # Jika jumlah error message tidak ada
    if(count($message)==0){     
      $qrySave=mysql_query("INSERT INTO purchase_order_header SET po_number='$po_number', po_date='$po_date', 
                  customer_id='$customer_id', po_noted='$po_noted', input_date='$input_date', user_input='".$_SESSION['user_id']."'") or die ("Gagal query".mysql_error());
      if($qrySave){
        # Ambil semua data yang dipilih, berdasarkan yg login
        $tmpSql ="SELECT product_id, price, qty, user_id, sum(qty*price) as total FROM tmp_purchase_order_dtl WHERE user_id='".$_SESSION['user_id']."' group by product_id, price, qty, user_id";
        $tmpQry = mysql_query($tmpSql, $connect) or die ("Gagal Query Tmp".mysql_error());
        while ($tmpRow = mysql_fetch_array($tmpQry)) {
          // Masukkan semua barang yang udah diisi ke tabel PO detail
          $itemSql = "INSERT INTO purchase_order_detail SET po_number='$po_number', product_id='$tmpRow[product_id]', 
                total='$tmpRow[total]', qty='$tmpRow[qty]'";
            mysql_query($itemSql, $connect) or die ("Gagal Query Simpan detail barang".mysql_error());
          
        }
        # Kosongkan Tmp jika datanya sudah dipindah
        mysql_query("DELETE FROM tmp_purchase_order_dtl WHERE user_id='".$_SESSION['user_id']."'", $connect) or die ("Gagal kosongkan tmp".mysql_error());
        
        ?>
    <script language="JavaScript">
    alert('PO <?=$po_number?> Saved Successfully!');
    window.close();
    </script>
  <?php

      }
      else{
        $message[] = "Gagal penyimpanan ke database";
      }
    } 
  }  
  // ============================================================================

  # JIKA ADA PESAN ERROR DARI VALIDASI
  // (Form Kosong, atau Duplikat ada), Ditampilkan lewat kode ini
  if (! count($message)==0 ){
    echo "<div class='mssgBox'>";
    echo "<img src='image/attention.png' class='imgBox'> <hr>";
      $Num=0;
      foreach ($message as $indeks=>$pesan_tampil) { 
      $Num++;
        echo "&nbsp;&nbsp;$Num. $pesan_tampil<br>"; 
      } 
    echo "</div> <br>"; 
  }
  // ============================================================================

  } // Penutup POST
} // Penutup GET

# TAMPILKAN DATA KE FORM

$po_date   = isset($_POST['po_date']) ? $_POST['po_date'] : '';
$customer_id  = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';
$po_number  = isset($_POST['po_number']) ? $_POST['po_number'] : '';
?>



<form action="?page=input-po" method="post"  name="form_input_po">

<table width="750" cellspacing="1" class="table-common" style="margin-top:0px;">
  <tr>
    <td colspan="3" align="center"><h1>Form Input PO</h1> </td>
  </tr>
  
    <tr>
      <td>&nbsp;</td>
    </tr>
  <tr>
    <td><b>Product ID</b></td>
    <td><b>:</b></td>
    <td><b>
      <input name="txtKode" id="product_id" size="10" maxlength="20" readonly="readonly" />
      <input name="product_name" id="product_name" size="25" maxlength="25" readonly="readonly"/>
      &ensp;
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><b>Search</b></button>
    <td>
    </tr>
    <tr>
    <td></td>
    <td></td>
    <td>
      Qty :
<input class="angkaC" name="txtJumlah" size="2" maxlength="4" value="1" 
         onblur="if (value == '') {value = '1'}" 
           onfocus="if (value == '1') {value =''}"/>
<input name="btnPilih" type="submit" style="cursor:pointer;" value=" Pilih " /></td>
    </tr>
</table>
<td>&nbsp;</td>
    <td>&nbsp;</td>
<table class="table-list" width="750" border="0" cellspacing="1" cellpadding="2">

  <tr>
    <th colspan="9">Product List Purchase Order<br></th>
    </tr>
  <tr>
    <td width="18" align="center" bgcolor="#0000FF"><font color="#FFFFFF"><b>No</b></font></td>
    <td width="89" align="center" bgcolor="#0000FF"><font color="#FFFFFF"><b>Product Id</b></font></td>
    <td width="355" bgcolor="#0000FF"><font color="#FFFFFF"><b>Product Name</b></font></td>
    <td width="61" align="right" bgcolor="#0000FF"><font color="#FFFFFF"><b>Price</b></font></td>
    <td width="46" align="center" bgcolor="#0000FF"><font color="#FFFFFF"><b>Qty</b></font></td>
    <td width="82" align="right" bgcolor="#0000FF"><font color="#FFFFFF"><b>Subtotal</b></font></td>
    <td width="63" align="center" bgcolor="#FFCC00"><b>Delete</b></td>
  
  </tr>
<?php
$tmpSql ="SELECT master_product.*, tmp_purchase_order_dtl.id, tmp_purchase_order_dtl.price As price, tmp_purchase_order_dtl.qty 
    FROM master_product, tmp_purchase_order_dtl
    WHERE master_product.product_id=tmp_purchase_order_dtl.product_id AND tmp_purchase_order_dtl.user_id='".$_SESSION['user_id']."'
    ORDER BY master_product.product_id ";
$tmpQry = mysql_query($tmpSql, $connect) or die ("Gagal Query Tmp".mysql_error());
$total = 0; $qtyBrg = 0; $nomor=0;
while($tmpRow = mysql_fetch_array($tmpQry)) {
  $price  = $tmpRow['price'];
  $ID   = $tmpRow['id'];
  $subSotal = $tmpRow['qty'] * $tmpRow['price'];
  $total  = $total + ($tmpRow['qty'] * $tmpRow['price']);
  $qtyBrg = $qtyBrg + $tmpRow['qty'];
  
  $nomor++;
?>
  <tr>
    <td align="center"><b><?php echo $nomor; ?></b></td>
    <td align="center"><b><?php echo $tmpRow['product_id']; ?></b></td>
    <td><?php echo $tmpRow['product_name']; ?></td>
    <td align="right"><?php echo $tmpRow['price']; ?></td>
    <td align="center"><?php echo $tmpRow['qty']; ?></td>
    <td align="right"><?php echo $subSotal; ?></td>
    <td align="center" bgcolor="#FFFFCC"><a href="?page=input-po&Act=Delete&ID=<?php echo $ID; ?>" target="_self"><img src="image/hapus.gif" width="16" height="16" border="0" /></a></td>
  </tr>
<?php 
}?>
  <tr>
    <td colspan="4" align="right"><b>Grand Total : </b></td>
    <td align="center"><b><?php echo $qtyBrg; ?></b></td>
    <td align="right"><b><?php echo $total; ?></b></td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="750" cellspacing="1" class="table-common" style="margin-top:0px;">
  <tr>
    <td width="20%"><b>PO Number</b></td>
    <td width="1%"><b>:</b></td>
    <td width="79%"><input name="po_number" value="" size="15" maxlength="15" /></td>
  </tr>
    <td>&nbsp;</td>
  <tr>
    <td width="20%"><b>PO Date</b></td>
    <td width="1%"><b>:</b></td>
    <td width="79%"><input name="po_date" value="" size="9" maxlength="9" />
      <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form_input_po.po_date);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal2" /></a>
    </td>
  </tr>
    <td>&nbsp;</td>
  <tr>
    <td><b>Customer</b></td>
    <td><b>:</b></td>
    <td><input type="text" name="customer_id" id="customer_id" value="" size="7" maxlength="10" "/>
      <input type="text" name="customer_name" id="customer_name" value="" size="30" maxlength="30" "/>
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalcust"><b>Cari</b></button></td>
  </tr>
    <td>&nbsp;</td>
  <tr>
    <td><b>Catatan</b></td>
    <td><b>:</b></td>
    <td><input name="po_noted" value="" size="30" maxlength="100" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="center">
      <input name="btnSave" type="submit" class="btn btn-primary" value="Save"/>
      <input type="submit" class="btn btn-danger" name="submit2" value="Cancel" onClick="window.close();"/>
    </div></td>
    </tr>
</table>
<p>&nbsp;</p>
</form>


<!-- Modal ms product-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:800px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Search Product</h4>
                    </div>
                    <div class="modal-body">
                        <table id="lookup" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ProductID</th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //Data yang ditampilkan dari master supplier
                                mysql_connect('localhost', 'root', 'cahbagoes');
                                mysql_select_db('corporate');
                                $query = mysql_query('SELECT * FROM master_product where status ="T"');
                                while ($data = mysql_fetch_array($query)) {
                                    ?>
                                    <tr class="pilih" data-product_id="<?php echo $data['product_id']; ?>" data-product_name="<?php echo $data['product_name']; ?>" data-price="<?php echo $data['price']; ?>">
                                        <td><?php echo $data['product_id']; ?></td>
                                        <td><?php echo $data['product_name']; ?></td>
                                        <td><?php echo $data['price']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery-1.11.2.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/jquery.dataTables.js"></script>
        <script src="js/dataTables.bootstrap.js"></script>
        <script type="text/javascript">
//            jika dipilih, akan masuk ke input dan modal di tutup
            $(document).on('click', '.pilih', function (e) {
                document.getElementById("product_id").value = $(this).attr('data-product_id');
                document.getElementById("product_name").value = $(this).attr('data-product_name');
                $('#myModal').modal('hide');
            });
//            tabel lookup 
            $(function () {
                $("#lookup").dataTable();
            });
var spryradio = new Spry.Widget.ValidationRadio("spryradio");
        </script>


<!-- Modal ms bank-->
        <div class="modal fade" id="myModalcust" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:800px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Search Customer</h4>
                    </div>
                    <div class="modal-body">
                        <table id="lookupcust" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Company</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //Data yang ditampilkan dari master supplier
                                mysql_connect('localhost', 'root', 'cahbagoes');
                                mysql_select_db('corporate');
                                $query = mysql_query('SELECT * FROM master_customer ');
                                while ($data = mysql_fetch_array($query)) {
                                    ?>
                                    <tr class="pilih-cust" data-customer_id="<?php echo $data['customer_id']; ?>" data-customer_name="<?php echo $data['customer_name']; ?>" data-company_id="<?php echo $data['company_id']; ?>">
                                        <td><?php echo $data['customer_id']; ?></td>
                                        <td><?php echo $data['customer_name']; ?></td>
                                        <td><?php echo $data['company_id']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
//            jika dipilih, akan masuk ke input dan modal di tutup
            $(document).on('click', '.pilih-cust', function (e) {
                document.getElementById("customer_id").value = $(this).attr('data-customer_id');
                document.getElementById("customer_name").value = $(this).attr('data-customer_name');
                $('#myModalcust').modal('hide');
            });
      

//            tabel lookup 
            $(function () {
                $("#lookupcust").dataTable();
            });
var spryradio2 = new Spry.Widget.ValidationRadio("spryradio2");
        </script>


  </body>
</html>

<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>