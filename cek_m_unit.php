<?php 
require_once("module/model/koneksi/koneksi.php");

if(!empty($_POST["KODE_UNIT"])) 
{
	$KODE_UNIT = $_POST["KODE_UNIT"];

	//CEK APAKAH DATA USER SUDAH ADA?
	$query = getQuery("select count(*) as itung from m_unit where kode_unit = '$KODE_UNIT' order by nama_unit asc");
	while ($rowz = $query->fetch(PDO::FETCH_ASSOC))
	{
		$onok = $rowz["itung"];
	}
	//JIKA SUDAH ADA
	if($onok != 0)
	{
	?>
		<div class="alert alert-danger" role="alert">
		  Kode Unit sudah terdaftar!
		</div>
	<?php
	}	
}

?>
