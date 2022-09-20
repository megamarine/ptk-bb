<?php 
require_once("module/model/koneksi/koneksi.php");

if(!empty($_POST["KODEGRADE"])) 
{
	$KODEGRADE = $_POST["KODEGRADE"];

	//CEK APAKAH DATA USER SUDAH ADA?
	$query = getQuery("select count(*) as itung from m_grade where kode_grade = '$KODEGRADE' order by nama_grade asc");
	while ($rowz = $query->fetch(PDO::FETCH_ASSOC))
	{
		$onok = $rowz["itung"];
	}
	//JIKA SUDAH ADA
	if($onok != 0)
	{
	?>
		<div class="alert alert-danger" role="alert">
		  Kode Grade sudah terdaftar!
		</div>
	<?php
	}	
}

?>
