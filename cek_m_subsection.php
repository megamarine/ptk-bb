<?php 
require_once("module/model/koneksi/koneksi.php");

if(!empty($_POST["SUBSECTION"])) 
{
	$SUBSECTION = $_POST["SUBSECTION"];

	//CEK APAKAH DATA USER SUDAH ADA?
	$query = getQuery("select count(*) as itung from m_subsection where kode_subsection = '$SUBSECTION' order by nama_subsection asc");
	while ($rowz = $query->fetch(PDO::FETCH_ASSOC))
	{
		$onok = $rowz["itung"];
	}
	//JIKA SUDAH ADA
	if($onok != 0)
	{
	?>
		<div class="alert alert-danger" role="alert">
		  Kode Sub Section sudah terdaftar!
		</div>
	<?php
	}	
}

?>
