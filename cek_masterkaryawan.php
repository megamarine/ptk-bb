<?php 
require_once("module/model/koneksi/koneksi.php");

if(!empty($_POST["IDKARYAWAN"])) 
{
	$IDKARYAWAN = $_POST["IDKARYAWAN"];

	//CEK APAKAH DATA USER SUDAH ADA?
	$query = getQuery("select count(*) as itung, nama from master_karyawan where id_kary = '$IDKARYAWAN'");
	while ($rowz = $query->fetch(PDO::FETCH_ASSOC))
	{
		$onok = $rowz["itung"];
		$nama = $rowz["nama"];
	}
	//JIKA SUDAH ADA
	if($onok != 0)
	{
		echo $nama;
	}
}
?>
