<title>Cetak</title>


<?php
require ("lib/fpdf/fpdf.php");
require("lib/function-invoice.php");
include "config.php";

Class Kwitansi extends FPDF
{

	var $invoice_number, $invoice_date, $sub_total, $ppn, $total, $user_id_approve, $user_print_invoice, $invoice_noted, $faktur ;
	

	
	/* Header Kwitansi */
	function Header(){
		$this->SetFont('Arial','B',10);
		$this->Image('image/kop.png',12,8,40);
		$this->Ln(3);
		$this->Cell(157);
		$this->SetFillColor('255','255' ,'255' );
		
		$this->SetFont('Arial','',7);
		$this->Cell(185,3,'',0,1,'L');
		$this->Cell(157);
		$this->Cell(185,3,'',0,1,'L');
		$this->Cell(157);
		$this->Cell(185,3,'',0,1,'L');
		
		$this->Ln(10);
		$this->SetFont('Arial','B',9);
		$this->Cell(60,4,$this->headerCo,0,1,'C');
		$this->SetFont('Arial','',9);
		$this->Cell(58,4,'Gedung Alfatower Floor 21',0,1,'C');
		$this->Cell(1);
		$this->Cell(88,4,'Jalur Sutera Barat Kav.7-9 Panunggangan Timur,',0,1,'C');
		$this->Cell(1);
		$this->Cell(67,4,'Pinang, Tangerang, Banten 15143',0,0,'C');
		$this->Ln(7);
		$this->SetFont('Arial','B',19);
		$this->Cell(200,5,'INVOICE',0,1,'C');
		$this->Ln(4);
		$this->SetFont('Arial','',9);
		$this->Cell(198,5,$this->kwnums,0,1,'C');
		
		$this->Cell(133);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,4,'Kepada :',0,1,'L');
		$this->Cell(133);
		$this->SetFont('Arial','',9);
		$this->MultiCell(55,4,$this->cih_mc_company_name,0,1,'L');
		$this->Cell(133);
		$this->Cell(30,4,'Branch : '.$this->cih_mc_branch_name,0,1,'L');
		$this->Cell(133);
		$this->Cell(30,4,'UP : '.$this->cih_mc_for_attention,0,1,'L');
		$this->Cell(133);
		$this->Cell(30,7,' ',0,1,'L');
		
	}
	
	
	
	/* Footer Kwitansi*/
	function Footer(){
		
	}
	function setHeaderParam($pt,$head){
		$this->headerCo=$pt;
		$this->headerAddr=$head;
		
		/*create by marcus dedy*/
		}
	function setTanggal($tgl){$this->tanggal=$tgl;}
	function setAdmins($admins){$this->admins=$admins;}
	function setKwtNums($kwnums){$this->kwnums=$kwnums;}
	function setValidasi($word){$this->notevalid=$word;}
	function setinvoice_number($invoice_number){$this->invoice_number=$invoice_number;}
	function setinvoice_date($invoice_date){$this->invoice_date=$invoice_date;}
	function setsub_total($sub_total){$this->sub_total=$sub_total;}
	function setppn($ppn){$this->ppn=$ppn;}
	function settotal($total){$this->total=$total;}
	function setuser_id_approve($user_id_approve){$this->user_id_approve=$user_id_approve;}
	function setuser_print_invoice($user_print_invoice){$this->user_print_invoice=$user_print_invoice;}
	function setinvoice_noted($invoice_noted){$this->invoice_noted=$invoice_noted;}
	function setfaktur($faktur){$this->faktur=$faktur;}
	function setposition($position){$this->position=$position;}
	function setuser_name($user_name){$this->user_name=$user_name;}
}


/*Deklarasi variable untuk cetak*/
$pt='PT.Sumber Trijaya Lestari';
$head='';
$invoice_number		=$_POST['invoice_number']; 
$invoice_date 		=$_POST['invoice_date']; 
$sub_total 			=$_POST['sub_total'];
$ppn				=$_POST['ppn']; 
$total				=$_POST['total'];
$user_id_approve	=$_POST['user_id_approve'];
$user_print_invoice	=$_POST['user_print_invoice']; 
$invoice_noted		=$_POST['invoice_noted']; 
$faktur				=$_POST['faktur'];
$position 			=$_POST['position'];
$user_name 			=$_POST['user_name']; 


/*parameter kertas*/
$pdf=new Kwitansi('P','mm','A4');
$fungsi=new Fungsi();
$tglCetak=$fungsi->Tanggal('tgl').' '.$fungsi->Tanggal('blnL').' '.$fungsi->Tanggal('THN');
/* Retrieve No. Invoice*/
$KwtNum = $fungsi->KwNums();
/*Persiapan Parameter  */
$pdf->setTanggal($tglCetak);
$pdf->setKwtNums($KwtNum);
$pdf->setHeaderParam($pt,$head);
$pdf->setinvoice_number($invoice_number);
$pdf->setinvoice_date($invoice_date);
$pdf->setsub_total($subtotal);
$pdf->setppn($ppn);
$pdf->settotal($total);
$pdf->setuser_id_approve($user_id_approve);
$pdf->setuser_print_invoice($user_print_invoice);
$pdf->setinvoice_noted($invoice_noted);
$pdf->setfaktur($faktur);
$pdf->setposition($position);
$pdf->setuser_name($user_name);

/* Bagian di mana inti */

$pdf->setMargins(5,5,5);
$pdf->AddPage();
$pdf->SetLineWidth(0.5);
$pdf->SetFont('Arial','',9);
$pdf->SetX(3); 
$pdf->SetLineWidth(0.1); 
$pdf->Ln(7); 
$pdf->SetFont('Arial','B',9);
$pdf->Cell(7);
$pdf->Cell(7,5,'No',1,0,'C');
$pdf->Cell(27,5,'No PO',1,0,'C');
$pdf->Cell(25,5,'No Faktur',1,0,'C');
$pdf->Cell(15,5,'PLU',1,0,'C');
$pdf->Cell(86,5,'Descp',1,0,'C');
$pdf->Cell(10,5,'Qty',1,0,'C');    
$pdf->Cell(20,5,'Total Price',1,0,'C');

$pdf->SetFont('Arial','',8); 
$pdf->Ln(); 
$hasi=mysql_query(" select a.po_number, c.faktur, a.product_id, b.product_name, a.qty, a.total from 
(select po_number, product_id, qty, total from purchase_order_detail)a,
(select product_id, product_name, price from master_product)b,
(select faktur, po_number from faktur_jual)c
where a.po_number = c.po_number and a.product_id = b.product_id and c.faktur ='".$_POST['faktur']."'");


$nomer=1; 
while($hasil=mysql_fetch_array($hasi)){ $pdf->SetFillColor(255,255,255); 
$pdf->Cell(7);
$pdf->Cell(7,5,$nomer++,1,0,'C',true);
$pdf->Cell(27,5,$hasil[0],1,0,'C',true);
$pdf->Cell(25,5,$hasil[1],1,0,'C',true);  
$pdf->Cell(15,5,$hasil[2],1,0,'C',true); 
$pdf->Cell(86,5,$hasil[3],1,0,'L',true);
$pdf->Cell(10,5,$hasil[4],1,0,'R',true);
$pdf->Cell(20,5,$hasil[5],1,0,'R',true); 
 
$pdf->Ln(); 
} 
$pdf->SetFont('Arial','',9);
$pdf->Cell(7); 
$pdf->Cell(27,7,'',0,0,'L'); 
$pdf->SetFont('Arial','B',8);
$pdf->Cell(97);  
$pdf->Cell(46,5,'Total Netto',1,0,'L'); 
$pdf->Cell(20,5,number_format($sub_total,0,',',','),1,1,'R');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(131); 
$pdf->Cell(46,5,'PPN 10%',1,0,'L'); 
$pdf->Cell(20,5,number_format($ppn,0,',',','),1,1,'R'); 
$pdf->SetFont('Arial','B',8);
$pdf->Cell(131);  
$pdf->Cell(46,5,'Total Invoice',1,0,'L'); 
$pdf->Cell(20,5,number_format($total,0,',',','),1,1,'R');  
$pdf->Ln(5); 
$pdf->SetFont('Arial','',8);
$pdf->Cell(7);
$pdf->MultiCell(190,4,'Terbilang : #'.$fungsi->Terbilang($total).'RUPIAH #',0,'L');
$pdf->Ln(9); 
$pdf->SetFont('Arial','',9);  
$pdf->Cell(5);
$pdf->Cell(70,6,'Note : '.$invoice_noted,0,1,'L'); 



		$pdf->Ln(10);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(5);
		$pdf->Cell(70,3,'Pembayaran mohon ditransfer, Cek/Giro ke rekening :',0,0,'L');
		$pdf->Cell(50);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(0,4,'Tangerang, '.$tglCetak,0,1,'C');
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(5);
		$pdf->Cell(70,4,'BCA KCP M.H. Thamrin',0,1,'L');
		$pdf->Cell(5);
		$pdf->Cell(70,4,'A/C 6890464333',0,1,'L');
		$pdf->Cell(5);
		$pdf->Cell(70,4,'A/N PT. Sumber Trijaya Lestari',0,1,'L');
		$pdf->Ln(24);
		$pdf->Cell(120);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(0,4,''.$user_name,0,1,'C');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(120);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(0,4,''.$position,0,1,'C');
		$pdf->Cell(5);
		$pdf->SetFont('Arial','IB',10);
		$pdf->Cell(70,4,'Note :',0,1,'L');
		$pdf->Cell(5);
		$pdf->SetFont('Arial','I',8);
		$pdf->Cell(70,3,'- Harap mencantumkan no invoice pada bukti transfer',0,1,'L');
		$pdf->Cell(5);
		$pdf->Cell(70,3,'- Pembayaran dianggap sah apabila dana sudah cair di rekening kami',0,1,'L');


$pdf->SetAuthor('http://www.marcusdedy.blogspot.com',true);
$name = $faktur;
$pdf->Output('files\invoice\ '.$name.'.pdf');
$fungsi->insertData($invoice_number, $invoice_date, $sub_total, $ppn, $total, $user_id_approve, $user_print_invoice, $invoice_noted, $faktur);
?>


