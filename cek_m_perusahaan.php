<?php 
require_once("module/model/koneksi/koneksi.php");

if(!empty($_POST["PERUSAHAAN"])) 
{
	$PERUSAHAAN = $_POST["PERUSAHAAN"];

	//CEK APAKAH DATA USER SUDAH ADA?
	$query = getQuery("select count(*) as itung from m_perusahaan where kode_perusahaan = '$PERUSAHAAN'");
	while ($rowz = $query->fetch(PDO::FETCH_ASSOC))
	{
		$onok = $rowz["itung"];
	}
	//JIKA SUDAH ADA
	if($onok != 0)
	{
	?>
		<div class="alert alert-danger" role="alert">
		  Kode Perusahaan sudah terdaftar!
		</div>
	<?php
	}	
}

?>
