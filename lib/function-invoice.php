<?php

require('config-inv.php');
Class Fungsi extends InvConfig{	

			function Terbilang($satuan){
			$huruf = array("","SATU","DUA","TIGA","EMPAT","LIMA","ENAM","TUJUH","DELAPAN","SEMBILAN","SEPULUH","SEBELAS");
			if($satuan<12)
			return " ".$huruf[$satuan];
			else if($satuan<20)
			return $this->Terbilang($satuan-10)." BELAS";
			else if($satuan<100)
			return $this->Terbilang($satuan/10)." PULUH".$this->Terbilang($satuan%10);
			elseif($satuan<200)
			return " SERATUS".$this->Terbilang($satuan-100);
			elseif($satuan<1000)
			return $this->Terbilang($satuan/100)." RATUS".$this->Terbilang($satuan%100);
			elseif($satuan<2000)
			return "SERIBU ".$this->Terbilang($satuan-1000);
			elseif($satuan<1000000)
			return $this->Terbilang($satuan/1000)." RIBU".$this->Terbilang($satuan%1000);
			elseif($satuan<1000000000)
			return $this->Terbilang($satuan/1000000)." JUTA".$this->Terbilang($satuan%1000000);
			elseif($satuan<1000000000000)
			return $this->Terbilang($satuan/1000000000)." MILYAR".$this->Terbilang(fmod($satuan ,1000000000));
			
			echo "hasil terbilang tidak dapat di proses, nilai terlalu besar";
		}
		
		function Ribuan($angka){
			if($angka=='0')
		return '';
		 elseif($angka<100)
		return $angka.',-';
		else
		return number_format($angka,0,'','.').',-';
			}
		
		function Tanggal($param){
			$bulan=array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
			$bln=array('JAN','FEB','MAR','APR','MEI','JUN','JUL','AGU','SEP','OKT','NOV','DES');
			$blnRoma=array('I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII');
			switch($param){
				case 'tgl' : return date('d');//tanggal dengan 2 digit Angka
				break;
				case 'blnL' : return $bulan[date('m')-1];//nama bulan lengkap bahasa Indonesia
				break;
				case 'blnk' : return $bln[date('m')-1];//nama bulan singkat bahasa Indonesia
				break;
				case 'romawi' : return $blnRoma[date('m')-1];//bulan dalam angka romawi;
				break;
				case 'blnAngka' : return date('m'); // bulan dengan angka latin biasa, 2 digit;
				break;
				case 'THN' : return date('Y');//4 digit Tahun
				break;
				case 'th' : return date('y');//2 digit Tahun
				break;
				default: return '';
				}
			}

		function ConnectDB(){
			if($this->conn )
				mysql_select_db($this->dbName);
		}
		function RetriveLastKwNums(){
			$LastKwNum='';
			$this->ConnectDB();
			$sql = 'select invoice_number from invoice';
			$retval = mysql_query($sql, $this->conn);
			while ($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
				$LastKwNum =  $row['invoice_number'];
			}

			if($LastKwNum=='')
				$LastKwNum = 0;
			return $LastKwNum;
			mysql_close($this->conn);
			}
/*create by marcus dedy*/
		function tambahNol($x){
			$y=($x>9)?($x>99)?$x:'0'.$x:'00'.$x;
			return $y;
		}

		function KwNums(){
			$LastKwNum = explode('/',$this->RetriveLastKwNums());
			//mereset nomor jika
			if(count($LastKwNum)>1){
			if(intval($LastKwNum[4])!=$this->Tanggal('th'))
				$LastKwNum[0] = 1;
			else
			$LastKwNum[0]++;
	}
	else {$LastKwNum[0]++;}

			return $this->tambahNol($LastKwNum[0]).$this->kwNumPattern;
		}
		function insertData(){
			//insert nomor invoice terbaru
			$this->ConnectDB();
			$invoice_number 		= $this->KwNums();
			// $invoice_date 			= $this->Tanggal('tgl').' '.$this->Tanggal('blnL').' '.$this->Tanggal('THN');
			$invoice_date			= DATE("Y-m-d");
			$sub_total 				= $_POST['sub_total'];
			$ppn 					= $_POST['ppn'];
			$total 					= $_POST['total'];
			$user_id_approve		= $_POST['user_id_approve'];
			$user_print_invoice		= $_POST['user_print_invoice'];
			$invoice_noted			= $_POST['invoice_noted'];
			$faktur					= $_POST['faktur'];
			$sql = "INSERT INTO invoice (invoice_number, invoice_date, sub_total, ppn, total, user_id_approve, user_print_invoice, invoice_noted, faktur) VALUES ('$invoice_number', '$invoice_date', '$sub_total', '$ppn', '$total', '$user_id_approve', '$user_print_invoice', '$invoice_noted', '$faktur')";
			if(!mysql_query($sql,$this->conn))
				echo "gagal -> ".mysql_error();
			else
				echo "berhasil";
				($query);{
	header('location:files/invoice/ '.$faktur.'.pdf' );
} ; 

		}
}
?>
