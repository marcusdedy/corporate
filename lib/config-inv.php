<?php
Class InvConfig{
	function __Construct(){
		$this->dbhost = 'localhost';
		$this->dbuser = 'root';
		$this->dbpass = 'cahbagoes';
		$this->dbName = 'corporate';
		$this->conn = mysql_connect($this->dbhost, $this->dbuser, $this->dbpass);
		$this->kwNumPattern = "/INV-CORP/HO-STL/".$this->Tanggal('romawi')."/".$this->Tanggal('th');
		
	}
}
?>