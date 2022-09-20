<?php 
require_once("module/model/koneksi/koneksi.php");

if(!empty($_POST["SECTION"])) 
{
	$SECTION = $_POST["SECTION"];

	//CEK APAKAH DATA USER SUDAH ADA?
	$query = getQuery("select count(*) as itung from m_section where kode_section = '$SECTION' order by nama_section asc");
	while ($rowz = $query->fetch(PDO::FETCH_ASSOC))
	{
		$onok = $rowz["itung"];
	}
	//JIKA SUDAH ADA
	if($onok != 0)
	{
	?>
		<div class="alert alert-danger" role="alert">
		  Kode Section sudah terdaftar!
		</div>
	<?php
	}	
}

?>
