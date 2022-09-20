<?php 
require_once("module/model/koneksi/koneksi.php");

if(!empty($_POST["KODE_USER"])) 
{
	$KODE_USER = $_POST["KODE_USER"];

	//CEK APAKAH DATA USER SUDAH ADA?
	$query = getQuery("select count(*) as itung from m_user where kode_user = '$KODE_USER'");
	while ($rowz = $query->fetch(PDO::FETCH_ASSOC))
	{
		$onok = $rowz["itung"];
	}
	//JIKA SUDAH ADA
	if($onok != 0)
	{
	?>
		<div class="alert alert-danger" role="alert">
		  Username sudah terdaftar!
		</div>
	<?php
	}	
}

?>
