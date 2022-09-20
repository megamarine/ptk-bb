<?php 
require_once("module/model/koneksi/koneksi.php");

if(!empty($_POST["KODELEVEL"])) 
{
	$KODELEVEL = $_POST["KODELEVEL"];

	//CEK APAKAH DATA USER SUDAH ADA?
	$query = getQuery("select count(*) as itung from m_level where kode_level = '$KODELEVEL' order by nama_level asc");
	while ($rowz = $query->fetch(PDO::FETCH_ASSOC))
	{
		$onok = $rowz["itung"];
	}
	//JIKA SUDAH ADA
	if($onok != 0)
	{
	?>
		<div class="alert alert-danger" role="alert">
		  Kode Level sudah terdaftar!
		</div>
	<?php
	}	
}

?>
