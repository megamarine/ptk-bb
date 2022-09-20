<?php 
require_once("module/model/koneksi/koneksi.php");

if(!empty($_POST["TEAM"])) 
{
	$TEAM = $_POST["TEAM"];

	//CEK APAKAH DATA USER SUDAH ADA?
	$query = getQuery("select count(*) as itung from m_team where kode_team = '$TEAM'");
	while ($rowz = $query->fetch(PDO::FETCH_ASSOC))
	{
		$onok = $rowz["itung"];
	}
	//JIKA SUDAH ADA
	if($onok != 0)
	{
	?>
		<div class="alert alert-danger" role="alert">
		  Kode Team sudah terdaftar!
		</div>
	<?php
	}	
}

?>
