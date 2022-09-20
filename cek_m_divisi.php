<?php 
require_once("module/model/koneksi/koneksi.php");

if(!empty($_POST["DIVISI"])) 
{
	$DIVISI = $_POST["DIVISI"];

	//CEK APAKAH DATA USER SUDAH ADA?
	$query = getQuery("select count(*) as itung from m_divisi where kode_divisi = '$DIVISI'");
	while ($rowz = $query->fetch(PDO::FETCH_ASSOC))
	{
		$onok = $rowz["itung"];
	}
	//JIKA SUDAH ADA
	if($onok != 0)
	{
	?>
		<div class="alert alert-danger" role="alert">
		  Kode Divisi sudah terdaftar!
		</div>
	<?php
	}	
}

?>
