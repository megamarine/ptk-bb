<?php 
require_once("module/model/koneksi/koneksi.php");

if(!empty($_POST["DEPARTEMENT"])) 
{
	$DEPARTEMENT = $_POST["DEPARTEMENT"];

	//CEK APAKAH DATA USER SUDAH ADA?
	$query = getQuery("select count(*) as itung from m_departement where kode_departement = '$DEPARTEMENT'");
	while ($rowz = $query->fetch(PDO::FETCH_ASSOC))
	{
		$onok = $rowz["itung"];
	}
	//JIKA SUDAH ADA
	if($onok != 0)
	{
	?>
		<div class="alert alert-danger" role="alert">
		  Kode Departement sudah terdaftar!
		</div>
	<?php
	}	
}

?>
